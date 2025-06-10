<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "Hafsa@2005";  
$basededatos = "proyecto_db";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
