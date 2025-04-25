<?php
// Obtener el tipo de backup desde el botón
if (!isset($_GET['tipo'])) {
    die("Tipo de backup no especificado.");
}

$tipo = $_GET['tipo'];

// Verificamos si el tipo es válido
if ($tipo !== 'linux' && $tipo !== 'windows') {
    die("Tipo de backup inválido.");
}

// Datos de conexión a la base de datos
$host = 'localhost';
$db = 'proyecto_db';
$user = 'root';
$pass = 'Hafsa@2005';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener la ruta del playbook desde la base de datos
    $stmt = $pdo->prepare("SELECT ruta FROM playbooks WHERE nombre = :nombre");
    $playbook_nombre = ($tipo === 'linux') ? 'Backup Linux' : 'Backup Windows';
    $stmt->bindParam(':nombre', $playbook_nombre);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$resultado) {
        die("Playbook no encontrado en la base de datos.");
    }

    $playbook_ruta = $resultado['ruta'];

    // Configurar el archivo de inventario
    $inventario = '/var/www/html/proyecto/inventory.ini';

    // Configurar ANSIBLE para usar directorio temporal sin errores
    $ansible_cfg = '/var/www/html/proyecto/ansible.cfg';
    $env = "ANSIBLE_CONFIG=$ansible_cfg ANSIBLE_REMOTE_TEMP=/tmp/.ansible/tmp";

    // Añadimos redirección de errores para capturar todo
    $comando = "$env ansible-playbook $playbook_ruta -i $inventario 2>&1";

    exec($comando, $output, $result);

    echo "<h3>Resultado del Backup ($tipo)</h3>";
    echo "<h4>Comando ejecutado:</h4><pre>$comando</pre>";
    echo "<h4>Código de salida:</h4><pre>$result</pre>";
    echo "<h4>Salida del comando:</h4><pre>";
    print_r($output);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>

