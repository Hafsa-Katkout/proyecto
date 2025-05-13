<?php
// ejecutar_accion.php

// Recoger los datos enviados por POST
$ip = escapeshellarg($_POST['ip']);
$user = escapeshellarg($_POST['user']);
$password = escapeshellarg($_POST['password']);

// Comando Ansible usando SSH con PowerShell
$command = "ANSIBLE_HOST_KEY_CHECKING=False ansible-playbook /var/www/html/proyecto/playbooks/windows_espacio.yml "
         . "-i $ip, "
         . "--extra-vars \"ansible_user=$user ansible_password=$password "
         . "ansible_connection=ssh ansible_shell_type=powershell "
         . "ansible_ssh_common_args='-o StrictHostKeyChecking=no'\"";

// Mostrar el resultado en pantalla
echo "<pre>";
passthru($command);
echo "</pre>";
?>
