<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Procesar formulario solo si fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start(); // Iniciar buffer para que header funcione luego

    $ip = $_POST['ip'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $clave_privada = $_POST['clave_privada'] ?? '';

    if (!empty($ip) && !empty($usuario) && !empty($clave_privada)) {
        try {
            // Verificar si ya existe
            $stmt = $conn->prepare("SELECT id FROM datos WHERE ip = ? AND usuario = ? AND clave_privada = ?");
            $stmt->execute([$ip, $usuario, $clave_privada]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                // Redirigir si ya existe
                header("Location: ejecutar.php?id=" . $existing['id']);
                exit();
            } else {
                // Generar ruta única
                $base_path = "/home/ubuntu/.ssh/clave";
                $ruta_clave = $base_path;
                $counter = 1;

                while (true) {
                    $stmt2 = $conn->prepare("SELECT COUNT(*) FROM datos WHERE ruta_clave = ?");
                    $stmt2->execute([$ruta_clave]);
                    $exists = $stmt2->fetchColumn();

                    if ($exists == 0) break;

                    $counter++;
                    $ruta_clave = $base_path . $counter;
                }

                // Insertar en la base de datos
                $insert = $conn->prepare("INSERT INTO datos (ip, usuario, clave_privada, ruta_clave, fecha_registro) VALUES (?, ?, ?, ?, NOW())");
                $insert->execute([$ip, $usuario, $clave_privada, $ruta_clave]);

                $new_id = $conn->lastInsertId();

                // Redirigir al archivo ejecutar.php
                header("Location: ejecutar.php?id=$new_id");
                exit();
            }
        } catch (PDOException $e) {
            $error_message = "Error de base de datos: " . $e->getMessage();
        }
    } else {
        $error_message = "Todos los campos son obligatorios.";
    }

    ob_end_clean(); // Detener buffer para evitar conflictos con header()
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir nueva máquina</title>
    <style>
        /* Igual que antes (puedes mantener tu estilo original) */
    </style>
</head>
<body>
    <?php if (!empty($error_message)): ?>
        <div style="color: red; text-align: center; margin-bottom: 10px;">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="ip">Dirección IP:</label>
        <input type="text" name="ip" required>

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="clave_privada">Clave privada:</label>
        <textarea name="clave_privada" rows="5" required></textarea>

        <input type="submit" value="Guardar máquina">
    </form>
</body>
</html>
