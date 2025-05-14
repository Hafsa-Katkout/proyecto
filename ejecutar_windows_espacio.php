<?php
// ejecutar_accion.php

// Recoger los datos enviados por POST
$ip = escapeshellarg($_POST['ip']);
$user = escapeshellarg($_POST['user']);
$password = escapeshellarg($_POST['password']);

// Comando Ansible
$command = "sudo ansible-playbook /var/www/html/proyecto/playbooks/windows_espacio.yml "
         . "-i $ip, "
         . "--extra-vars \"ansible_python_interpreter=python3 ansible_user=$user ansible_password=Hafsa@2005 "
         . "ansible_connection=ssh ansible_shell_type=powershell "
         . "ansible_ssh_common_args='-o StrictHostKeyChecking=no'\"";

         echo $command ;

// Configurar descriptores para capturar stdout y stderr
$descriptorspec = [
    1 => ["pipe", "w"], // stdout
    2 => ["pipe", "w"]  // stderr
];

// Ejecutar el comando
$process = proc_open($command, $descriptorspec, $pipes);

echo "<pre>";

if (is_resource($process)) {
    // Leer salida estándar
    while ($line = fgets($pipes[1])) {
        echo htmlspecialchars($line);
    }

    // Leer errores
    $stderr_output = stream_get_contents($pipes[2]);
    if (!empty($stderr_output)) {
        echo "\n\n--- ERRORES DETECTADOS ---\n";
        echo htmlspecialchars($stderr_output);
    }

    // Cerrar los pipes
    fclose($pipes[1]);
    fclose($pipes[2]);

    // Obtener el código de salida
    $return_value = proc_close($process);
    echo "\n\n--- EJECUCIÓN FINALIZADA ---\n";
    echo "Código de salida: $return_value\n";
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
