<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión con la base de datos
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip = $_POST['ip'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $clave_privada = $_POST['clave_privada'] ?? '';

    if (!empty($ip) && !empty($usuario) && !empty($clave_privada)) {
    // Process data
} else {
    $missing = [];
    if (empty($ip)) $missing[] = 'IP';
    if (empty($usuario)) $missing[] = 'Usuario';
    if (empty($clave_privada)) $missing[] = 'Clave privada';
    die('Faltan los siguientes campos obligatorios: ' . implode(', ', $missing));
} {
        try {
            // Verificar si ya existe exactamente
            $stmt = $conn->prepare("SELECT id FROM datos WHERE ip = ? AND usuario = ? AND clave_privada = ?");
            $stmt->execute([$ip, $usuario, $clave_privada]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                echo '<div class="message success">¡Los datos ya existen! Redirigiendo...</div>';
                header("refresh:2;url=ejecutar.php?id=" . $existing['id']);
                exit();
            } else {
                // Generar ruta_clave única en /home/ubuntu/.ssh/
                $base_path = "/home/ubuntu/.ssh/clave";
                $ruta_clave = $base_path;
                $counter = 1;

                // Verifica si ya existe esa ruta
                while (true) {
                    $stmt2 = $conn->prepare("SELECT COUNT(*) FROM datos WHERE ruta_clave = ?");
                    $stmt2->execute([$ruta_clave]);
                    $exists = $stmt2->fetchColumn();

                    if ($exists == 0) {
                        break;
                    }
                    $counter++;
                    $ruta_clave = $base_path . $counter;
                }

                // Insertar nuevo registro
                $insert = $conn->prepare("INSERT INTO datos (ip, usuario, clave_privada, ruta_clave, fecha_registro) VALUES (?, ?, ?, ?, NOW())");
                $insert->execute([$ip, $usuario, $clave_privada, $ruta_clave]);

                $new_id = $conn->lastInsertId();
                echo '<div class="message success">¡Datos insertados correctamente! Redirigiendo...</div>';
                header("refresh:2;url=ejecutar.php?id=$new_id");
                exit();
            }
        } catch (PDOException $e) {
            echo '<div class="message error">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir nueva máquina</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('images/addupdate2.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #444;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        input[type="submit"] {
            margin-top: 25px;
            padding: 12px;
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
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
    <form method="POST">
    <label for="ip">Dirección IP:</label>
    <input type="text" name="ip" required>

    <label for="usuario">Usuario:</label>
    <input type="text" name="usuario" required>

    <label for="clave_privada">Clave privada:</label>
    <textarea name="clave_privada" rows="5" required></textarea>

    <input type="submit" value="Guardar máquina">
</form>


    <div class="botones-superiores">
        <a href="backupMachine.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>
</body>
</html>
