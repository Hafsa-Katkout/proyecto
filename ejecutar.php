<?php
include("db.php");

if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];

    $stmt = $conn->prepare("SELECT ruta FROM playbooks WHERE grupo_ansible = ?");
    $stmt->bind_param("s", $tipo);
    $stmt->execute();
    $stmt->bind_result($ruta);
    $stmt->fetch();
    $stmt->close();

    $inventario = "/var/www/html/proyecto/inventory.ini";
    $comando = "ansible-playbook -i $inventario $ruta 2>&1";
    $salida = shell_exec($comando);

    echo "<h2>Resultado del Backup ($tipo)</h2><pre>$salida</pre>";
} else {
    echo "Tipo no especificado.";
}
?>
