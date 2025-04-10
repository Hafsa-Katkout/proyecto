<?php
include 'dbconfig.php';  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];

    // Verificar que no haya usuario existente con ese nombre
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario");
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch();

    if ($usuario) {
        $error = "El nombre de usuario ya está en uso.";
    } else {
        // Encriptar la contraseña antes de guardarla
        $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, email) VALUES (:nombre_usuario, :contrasena, :email)");
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Redirigir al usuario a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registrarse</h1>
    <form method="POST" action="registro.php">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" required>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required>

        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>

