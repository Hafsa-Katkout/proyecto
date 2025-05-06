<?php
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

    echo "IP: $ip<br>";
    echo "Usuario: $usuario<br>";
    echo "Ruta clave: $ruta_clave<br>";
    echo "Clave privada (parte): " . htmlspecialchars(substr($clave_privada, 0, 30)) . "...<br><br>";

    // Crear el archivo con el contenido de la clave privada

    // Step 1: Preserve the first and last lines
$first_line = '-----BEGIN RSA PRIVATE KEY-----';
$last_line = '-----END RSA PRIVATE KEY-----';

// Step 2: Remove the first and last lines from the private key
$clave_privada_middle = substr($clave_privada, strlen($first_line), -strlen($last_line));

// Step 3: Replace spaces with line breaks in the middle part of the key
// This will ensure we replace spaces with \n but not introduce any empty lines
$clave_privada_middle_with_linebreaks = str_replace(' ', "\n", $clave_privada_middle);

// Step 4: Reassemble the key with the first and last lines intact, ensuring no extra empty lines
$clave_privada_final = $first_line . "\n" . trim($clave_privada_middle_with_linebreaks) . "\n" . $last_line;

// Step 5: Escape the final key to handle special characters correctly for shell execution
$clave_privada_final_escaped = escapeshellarg($clave_privada_final);

// Step 6: Write the private key with the modified line breaks using sudo and tee
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
