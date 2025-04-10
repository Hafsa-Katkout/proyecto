<?php
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
if (!isset($_SESSION['usuario_id'])) {
    echo "Sesión no iniciada. Redirigiendo a login...";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
</head>
<body>
    <h1>Bienvenido al panel de control</h1>
    <p>Tu ID de usuario es: <?php echo $_SESSION['usuario_id']; ?></p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
