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
// Recoger los datos enviados por POST
$ip = escapeshellarg($_POST['ip']);
$user = escapeshellarg($_POST['user']);
$password = escapeshellarg($_POST['password']);

// Comando Ansible
$command = "ansible-playbook /var/www/html/proyecto/playbooks/windows_infoSystem.yml "
         . "-i $ip, "
         . "--extra-vars \"ansible_python_interpreter=python3 ansible_user=$user ansible_password=$password "
         . "ansible_connection=ssh ansible_shell_type=powershell "
         . "ansible_ssh_common_args='-o StrictHostKeyChecking=no'\"";

// Configurar descriptores para capturar stdout y stderr
$descriptorspec = [
    1 => ["pipe", "w"], // stdout
    2 => ["pipe", "w"]  // stderr
];

// Ejecutar el comando
$process = proc_open($command, $descriptorspec, $pipes);
 echo "<div class='resultado-contenedor'>";
    echo <<<HTML
<div class="botones-superiores">
        <a href="windows_info.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>
HTML;
echo "<pre>";

// Function to clean up output
function cleanOutput($line) {
    // Remove carriage returns (\r), newlines (\n), extra spaces, and trim
    return trim(preg_replace('/[\r\n]+/', ' ', $line));
}

if (is_resource($process)) {
    // Leer salida estándar
    while ($line = fgets($pipes[1])) {
        echo htmlspecialchars(cleanOutput($line)) . "<br>";  // Clean output before echoing
    }

    // Leer errores
    $stderr_output = stream_get_contents($pipes[2]);
    if (!empty($stderr_output)) {
        echo "<br><br>--- ERRORES DETECTADOS ---<br>";
        echo htmlspecialchars($stderr_output);
    }

    // Cerrar los pipes
    fclose($pipes[1]);
    fclose($pipes[2]);

    // Obtener el código de salida
    $return_value = proc_close($process);
    echo "<br><br>--- EJECUCIÓN FINALIZADA ---<br>";
    echo "Código de salida: $return_value<br>";
    if ($return_value !== 0) {
        echo "Hubo errores durante la ejecución del playbook.";
    } else {
        echo "El playbook se ejecutó correctamente.";
    }
} else {
    echo "No se pudo iniciar el proceso del playbook.";
}

echo "</pre>";
?>
