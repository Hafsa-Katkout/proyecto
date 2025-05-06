<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "Hafsa@2005", "proyecto_db");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultamos todas las máquinas
$consulta = "SELECT * FROM datos";
$resultado_maquinas = $conexion->query($consulta); // para las máquinas
$resultado_usuarios = $conexion->query("SELECT * FROM usuarios_ansible");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['contraseña'])) {
    $nombre = $_POST['nombre'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptación segura

    $stmt = $conexion->prepare("INSERT INTO usuarios_ansible (nombre, contraseña) VALUES (?, ?)");
$stmt->bind_param("ss", $nombre, $contraseña);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']); // Recarga automática
    exit();
}

// Obtener los usuarios existentes

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SysFero</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/back_usuarios_ansible.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-top: 40px;
            font-size: 2.5em;
            font-weight: 600;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 80%;
            margin: 40px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .boton {
            padding: 8px 18px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .boton-play {
            background-color: #28a745;
            color: white;
        }

        .boton-play:hover {
            background-color: #218838;
        }

        .boton-editar {
            background-color: #007bff;
            color: white;
        }

        .boton-editar:hover {
            background-color: #0056b3;
        }

        .boton-agregar {
            display: block;
            width: 200px;
            padding: 12px;
            margin: 30px auto;
            text-align: center;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .boton-agregar:hover {
            background-color: #0056b3;
        }

        /* FORMULARIO AÑADIR USUARIO */
        .form-container {
            max-width: 500px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #007bff;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 12px;
            margin-top: 25px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        .top-buttons {
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        .top-buttons button {
            background-color: #3498db;
            color: white;
            border: none;
            margin: 5px;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .top-buttons button:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            table {
                width: 95%;
            }

            .boton-agregar, .form-container {
                width: 90%;
            }

            h2 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>

    <h2>Elige la máquina dónde quieres añadir el usuario</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Dirección IP</th>
            <th>Usuario</th>
            <th>Ruta de la clave</th>
            <th>Acciones</th>
        </tr>

        <?php if ($resultado_maquinas->num_rows > 0): ?>
            <?php while ($fila = $resultado_maquinas->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['ip']; ?></td>
                    <td><?php echo $fila['usuario']; ?></td>
                    <td><?php echo $fila['ruta_clave']; ?></td>
                    <td>
                        <form action="executeUpdate.php" method="post" style="display:inline;">
                            <input type="hidden" name="ip" value="<?php echo $fila['ip']; ?>">
                            <input type="hidden" name="usuario" value="<?php echo $fila['usuario']; ?>">
                            <input type="hidden" name="ruta_clave" value="<?php echo $fila['ruta_clave']; ?>">
                            <button type="submit" class="boton boton-play">Elegir máquina</button>
                        </form>

                        <form action="modificarMachine.php" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <button type="submit" class="boton boton-editar">Modificar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No hay máquinas registradas.</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="addMachine.php" class="boton-agregar">Añadir nueva máquina</a>

    <!-- FORMULARIO AÑADIR USUARIO A LA MÁQUINA -->
    <div class="container">
    <h2>Usuarios Existentes en Ansible</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Contraseña (Hash)</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = $resultado_usuarios->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['id'] ?></td>
                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                <td><?= htmlspecialchars($fila['contraseña']) ?></td>
                <td class="actions">
                    <form action="modificar_user.php" method="GET">
                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                        <button type="submit">Modificar</button>
                    </form>
                    <form action="seleccionar_usuario.php" method="POST">
                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                        <button type="submit">Seleccionar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
    <div class="form-container">
            <h3>Añadir Nuevo Usuario</h3>
            <form action="" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>

                <button type="submit">Añadir Usuario</button>
            </form>
        </div>


</body>
</html>
