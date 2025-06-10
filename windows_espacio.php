<?php


// Configuración de la base de datos
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT * FROM windows_hosts");
    $hosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error al conectar con la base de datos: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Hosts Windows</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('/images/windows_espacio_back.jpg'); 
        background-size: cover;
        background-position: center;
        padding: 20px;
        color: #333;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        background: rgba(255, 255, 255, 0.8); 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); 
        border-radius: 10px;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        border-bottom: 2px solid #f0f0f0; 
        text-align: center;
    }

    th {
        background-color: #007BFF;
        color: white;
        font-size: 16px;
    }

    tr:hover {
        background-color: #f8f9fa;
    }

    .btn {
        padding: 12px 25px;
        text-decoration: none;
        color: black;
        background-color: white; 
        border-radius: 25px;
        font-size: 16px;
        display: inline-block;
        text-align: center;
        margin: 5px 10px;
        border: 2px solid black;
        transition: background-color 0.3s ease, color 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    }

    .btn-ver {
        border-color: black; 
        color: black;
    }

    .btn-accion {
        border-color: black;
        color: black;
    }

    .btn:hover {
        background-color: #b3e0ff;
        color: white; 
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); 
    }

    h2 {
        text-align: center;
        color: #fff;
        font-size: 2em;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .btn-add {
    background-color:rgb(83, 196, 238); 
    color: white;
    font-weight: bold;
    border-color:rgb(83, 196, 238);
}

.btn-add:hover {
    background-color:rgb(83, 196, 238);
    color: white;
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

     h {
    display: block;
    width: 60%;
    margin: 20px auto 0;
    color: white;
    text-align: center;
    font-size: 1.2em;
    font-weight: 600;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
}
</style>

</head>
<body>

<div class="container">
    <h2>Comprobación de Espacio en el Sistema Windows</h2>
    <a class="btn btn-add" href="agregar_windows.php"> Añadir nueva máquina</a>
    <h>Por favor, selecciona la máquina Windows en la que deseas comprobar el espacio disponible.</h>
    <h>Si necesitas ayuda o tienes alguna duda, puedes contactarnos en cualquier momento. Estamos a tu disposición.</h>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>IP</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hosts as $host): ?>
                <tr>
                    <td><?= htmlspecialchars($host['id']) ?></td>
                    <td><?= htmlspecialchars($host['ip']) ?></td>
                    <td><?= htmlspecialchars($host['usuario']) ?></td>
                    <td>
                        <?php
                        $hashed_password = password_hash($host['contrasena'], PASSWORD_BCRYPT);
                        echo htmlspecialchars($hashed_password); // Muestra el hash
                        ?>
                    </td>
                    <td><?= htmlspecialchars($host['tiempo_creación']) ?></td>
                    <td>
                        <a class="btn btn-ver" href="ver_host.php?id=<?= $host['id'] ?>">Modificar</a>
                        <form id="form-ejecutar-<?= $host['id'] ?>" action="ejecutar_windows_espacio.php" method="POST" style="display: none;">
                            <input type="hidden" name="ip" value="<?= $host['ip'] ?>">
                            <input type="hidden" name="user" value="<?= $host['usuario'] ?>">
                            <input type="hidden" name="password" value="<?= htmlspecialchars($host['contrasena']) ?>">
                        </form>

                    <a class="btn btn-accion" href="#" onclick="document.getElementById('form-ejecutar-<?= $host['id'] ?>').submit();">
                     Ejecutar acción
                    </a>

                    </td>
                </tr>
                <div class="botones-superiores">
        <a href="dashboard.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
