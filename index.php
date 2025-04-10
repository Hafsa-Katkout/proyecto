<?php
session_start();

// Si el usuario está autenticado, redirige a la página de bienvenida
if (isset($_SESSION['usuario_id'])) {
    header("Location: bienvenida.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenido a la Aplicación</h1>
    <p><a href="login.php">Iniciar sesión</a></p>
</body>
</html>
