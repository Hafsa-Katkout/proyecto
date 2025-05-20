<?php
echo <<<HTML
<style>
  body {
    margin: 0;
    padding: 0;
    background: url('/images/back_ejecutar.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }

  .resultado-contenedor {
  background-color: rgba(255, 255, 255, 0.95);
  color: #000;
  padding: 30px;
  width: 80%;
  max-width: 900px;
  margin: 100px auto 50px auto;
  border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}


  .resultado-contenedor pre {
    background-color: #f0f0f0;
    padding: 15px;
    border-radius: 8px;
    white-space: pre-wrap;
    word-break: break-word;
  }

  h3 {
    margin-top: 30px;
  }
  .botones-superiores {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1000;
    }

    .boton-navegacion {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        font-size: 14px;
        font-weight: bold;
        color: white;
        background-color: transparent;
        border: 2px solid white;
        border-radius: 6px;
        text-decoration: none;
        box-shadow: 0 0 8px white;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .boton-navegacion:hover {
        background-color: #e0f7ff;
        color: #007bff;
    }
</style>
HTML;
// Mostrar errores (para depuración)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
include("db.php");

function mostrarError($mensaje) {
    echo "<div style='color:red; font-weight:bold;'>$mensaje</div>";
}

// Verificamos si los datos fueron enviados por POST
if (isset($_POST['ip'], $_POST['usuario'], $_POST['ruta_clave'])) {
    $ip = $_POST['ip'];
    $usuario = $_POST['usuario'];
    $ruta_clave = $_POST['ruta_clave'];  // Ruta completa para guardar el archivo

    // Obtenemos la clave privada de la base de datos
    $stmt = $conn->prepare("SELECT clave_privada FROM datos WHERE ip = ?");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->bind_result($clave_privada);
    $stmt->fetch();
    $stmt->close();

    if (!$clave_privada) {
        mostrarError("Error: No se encontró la clave privada para esta máquina.");
        exit;
    }
    echo "<div class='resultado-contenedor'>";
    echo <<<HTML
<div class="botones-superiores">
        <a href="updateMachine.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>
HTML;

    echo "IP: $ip<br>";
    echo "Usuario: $usuario<br>";
    echo "Ruta clave: $ruta_clave<br>";
    echo "Clave privada (parte): " . htmlspecialchars(substr($clave_privada, 0, 30)) . "...<br><br>";

    // Crear el archivo con el contenido de la clave privada

// Decodificar la clave desde base64 (como está en la base de datos)
$clave_privada_decodificada = base64_decode($clave_privada);

// Escapar el contenido para usarlo en shell con seguridad
$clave_privada_final_escaped = escapeshellarg($clave_privada_decodificada);

// Crear el archivo con sudo usando echo + tee
$command = "echo $clave_privada_final_escaped | sudo tee $ruta_clave > /dev/null";
shell_exec($command);


// Step 7: Change the ownership and permissions using sudo
$command_chown = "sudo chown ubuntu:ubuntu $ruta_clave && sudo chmod 400 $ruta_clave";
shell_exec($command_chown);



   

    echo "Private key has been written, ownership and permissions updated!";
    $playbook = '/var/www/html/proyecto/playbooks/update_linux.yml'; // nombre de tu playbook
    $playbook = escapeshellarg($playbook);

    // Desactivamos la verificación de claves SSH y ejecutamos el playbook con IP directa
    $command = "sudo ansible-playbook -i $ip, -u $usuario --private-key $ruta_clave $playbook 2>&1";

    echo "<h3>Ejecutando:</h3><pre>$command</pre>";

    // Ejecutamos el comando y capturamos salida
    $output = shell_exec($command);

    echo "<h3>Resultado:</h3><pre>$output</pre>";
} else {
    mostrarError("Error: Faltan datos para ejecutar la actualización.");
}
?>
