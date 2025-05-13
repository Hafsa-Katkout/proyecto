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
            background-color: #f1f3f5;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-ver {
            background-color: #28a745;
        }
        .btn-accion {
            background-color: #ffc107;
        }
    </style>
</head>
<body>

<h2>Listado de Hosts Windows</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>IP</th>
            <th>Usuario</th>
            <th>Contraseña (Hasheada)</th>
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
                    $hashed_password = password_hash($host['contraseña'], PASSWORD_BCRYPT);
                    echo htmlspecialchars($hashed_password); // Muestra el hash
                    ?>
                </td>
                <td><?= htmlspecialchars($host['tiempo_creación']) ?></td>
                <td>
                    <a class="btn btn-ver" href="ver_host.php?id=<?= $host['id'] ?>">Ver detalles</a>
                    <a class="btn btn-accion" href="ejecutar_accion.php?id=<?= $host['id'] ?>">Ejecutar acción</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
