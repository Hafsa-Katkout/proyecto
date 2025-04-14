<?php
$host = "localhost";
$user = "root";
$pass = "Hafsa@2005";
$db = "proyecto_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
