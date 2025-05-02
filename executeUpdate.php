<?php
// Conexión a la base de datos
include("db.php");

// Verificamos si los datos fueron enviados por POST
if (isset($_POST['ip'], $_POST['usuario'], $_POST['ruta_clave'])) {
    $ip = $_POST['ip'];
    $usuario = $_POST['usuario'];
    $ruta_clave = $_POST['ruta_clave'];  // Asumimos que esta variable ya contiene la ruta completa del archivo

    // Obtenemos la clave privada de la base de datos
    $stmt = $conn->prepare("SELECT clave_privada FROM datos WHERE ip = ?");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->bind_result($clave_privada);
    $stmt->fetch();
    $stmt->close();

    if (!$clave_privada) {
        die("Error: No se encontró la clave privada para esta máquina.");
    }

    // Mostrar valores para depuración
    echo "IP: $ip<br>";
    echo "Usuario: $usuario<br>";
    echo "Ruta clave: $ruta_clave<br>";
    echo "Clave privada (parte): " . substr($clave_privada, 0, 30) . "...<br><br>";

    // Crear el archivo con el contenido de la clave privada en la ruta especificada
    if (file_put_contents($ruta_clave, $clave_privada) !== false) {
        echo "Archivo creado exitosamente en: $ruta_clave<br>";

        // Cambiar la propiedad del archivo a usuario:usuario
        $chownCommand = "chown www-data:$usuario $ruta_clave";
        shell_exec($chownCommand);

        // Cambiar los permisos del archivo a 400 (solo lectura para el propietario)
        $chmodCommand = "chmod 400 $ruta_clave";
        shell_exec($chmodCommand);

        echo "Propiedad y permisos del archivo actualizados.<br>";
    } else {
        echo "Error al crear el archivo.<br>";
    }

    // Ejecutamos el playbook de Ansible pasando las variables
    $command = "ansible-playbook /var/www/html/proyecto/playbooks/update_linux.yml --extra-vars " .
               "'ip=$ip usuario=$usuario ruta_clave=$ruta_clave clave_privada=\"$clave_privada\"'";

    // Mostrar comando para depuración
    echo "Comando Ansible: $command<br>";

    // Ejecutamos el comando
    $output = shell_exec($command);

    // Comprobamos si hubo salida
    if ($output === null) {
        echo "Error al ejecutar el playbook.<br>";
    } else {
        // Mostramos el resultado de la ejecución
        echo "<pre>$output</pre>";
    }

} else {
    die("Error: No machine selected.");
}
?>
