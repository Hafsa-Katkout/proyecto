<?php
$servidor = "localhost";
$usuario = "root"; // Cambiar si se usa otro usuario
$contrasena = "Hafsa@2005";  // Cambiar si se tiene una contraseña para el usuario root
$basededatos = "proyecto_db";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
