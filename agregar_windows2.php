<?php
// Conexión con la base de datos
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip = $_POST['ip'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("INSERT INTO windows_hosts (ip, usuario, contrasena, tiempo_creación) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$ip, $usuario, $contrasena]);

    // Redireccionar de vuelta al listado después de insertar
    header("Location: windows_update.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir nueva máquina</title>
    <style>
        body {
            font-family: Arial;
            padding: 30px;
            background-color: #f4f4f4;
        }

        form {
            background: #fff;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Añadir nueva máquina</h2>
        <label for="ip">Dirección IP:</label>
        <input type="text" name="ip" id="ip" required>

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <input type="submit" value="Guardar máquina">
        <a href="windows_lista.php">⬅ Volver</a>
    </form>
</body>
</html>
