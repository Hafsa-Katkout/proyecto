<?php
// Get the ID from the GET request
$id = $_GET['id'];

// Database connection details
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch the current data of the host
    $stmt = $conn->prepare("SELECT * FROM cisco_machines WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $host = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$host) {
        die("Host no encontrado");
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the updated values from the form
        $ip = $_POST['ip'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena']; // Changed to 'contrasena'

        // Update query
        try {
            // Prepare the update query
            $updateStmt = $conn->prepare("UPDATE cisco_machines SET ip = :ip, usuario = :usuario, contrasena = :contrasena WHERE id = :id");

            // Bind parameters
            $updateStmt->bindParam(':ip', $ip);
            $updateStmt->bindParam(':usuario', $usuario);
            $updateStmt->bindParam(':contrasena', $contrasena); // Changed to 'contrasena'
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT); // Ensure the ID is an integer

            // Execute the query
            $updateStmt->execute();

            // If the update was successful, redirect to windows_espacio.php
            header('Location: configuracion_cisco.php');
            exit; // Make sure to stop the execution after redirect

        } catch (PDOException $e) {
            echo "Error al actualizar los datos: " . $e->getMessage();
        }
    }

} catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Host</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/images/4.jpg');
            background-size: cover;
            background-position: center;
            padding: 20px;
            color: #333;
        }
        .container {
    max-width: 800px;
    margin: 100px auto 0 auto; /* Añadido margen arriba */
    padding: 20px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            padding: 10px;
            font-size: 14px;
            text-align: center;
            color: white;
            background-color: #007BFF;
            border-radius: 4px;
            text-decoration: none;
            width: 100px;
            margin: 10px auto;
            display: block;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .botones-superiores {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1000;
    }

    .boton-navegacion {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        font-size: 14px;
        font-weight: bold;
        color: white;
        background-color: transparent;
        border: 2px solid white;
        border-radius: 6px;
        text-decoration: none;
        box-shadow: 0 0 8px white;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .boton-navegacion:hover {
        background-color: #e0f7ff;
        color: #007bff;
    }
    </style>
</head>
<body>

<div class="container">
    <h2>Editar Host - ID: <?= htmlspecialchars($host['id']) ?></h2>

    <form action="" method="POST">
        <label for="ip">IP:</label>
        <input type="text" id="ip" name="ip" value="<?= htmlspecialchars($host['ip']) ?>" required>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($host['usuario']) ?>" required>

        <label for="contrasena">Contraseña:</label>
        <input type="text" id="contrasena" name="contrasena" value="<?= htmlspecialchars($host['contrasena']) ?>" required>

        <button type="submit" class="btn">Guardar cambios</button>
    </form>

    
</div>
<div class="botones-superiores">
        <a href="configuracion_cisco.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>

</body>
</html>
