<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "Hafsa@2005", "proyecto_db");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesamos el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = $conexion->real_escape_string($_POST['ip']);
    $usuario = $conexion->real_escape_string($_POST['usuario']);
    $clave_privada = $conexion->real_escape_string($_POST['clave_privada']);

    // Verificamos si la combinación exacta ya existe
    $consulta = "SELECT * FROM datos WHERE ip = '$ip' AND usuario = '$usuario' AND clave_privada = '$clave_privada'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        echo "<p>La máquina ya está registrada.</p>";
    } else {
        // Insertamos primero los datos SIN ruta_clave
        $insertar = "INSERT INTO datos (ip, usuario, clave_privada, ruta_clave) VALUES ('$ip', '$usuario', '$clave_privada', '')";

        if ($conexion->query($insertar) === TRUE) {
            $id_insertado = $conexion->insert_id;

            // Generamos la ruta_clave con "usuario" fijo
            $ruta_base = "/home/ubuntu/.ssh/clave";
            $ruta_final = $ruta_base;
            $contador = 2; // Comenzamos desde 2

            // Comprobamos si existe esa ruta
            while (true) {
                $consulta_ruta = "SELECT * FROM datos WHERE ruta_clave = '$ruta_final'";
                $resultado_ruta = $conexion->query($consulta_ruta);

                if ($resultado_ruta->num_rows == 0) {
                    // No existe, podemos usar esta ruta
                    break;
                } else {
                    // Ya existe, agregamos el contador
                    $ruta_final = $ruta_base . $contador;
                    $contador++;
                }
            }

            // Actualizamos el registro con la ruta_clave correcta
            $actualizar = "UPDATE datos SET ruta_clave = '$ruta_final' WHERE id = $id_insertado";

            if ($conexion->query($actualizar) === TRUE) {
                echo "<p>Datos insertados correctamente con ruta: $ruta_final</p>";
            } else {
                echo "<p>Error al actualizar la ruta: " . $conexion->error . "</p>";
            }
        } else {
            echo "<p>Error al insertar datos: " . $conexion->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar nueva máquina</title>
</head>
<body>
    <h2>Insertar datos de tu nueva máquina</h2>
    <form method="post" action="">
        <label for="ip">Dirección IP:</label><br>
        <input type="text" id="ip" name="ip" required><br><br>

        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="clave_privada">Clave Privada (formato texto):</label><br>
        <textarea id="clave_privada" name="clave_privada" rows="6" cols="50" required></textarea><br><br>

        <input type="submit" value="Insertar máquina">
    </form>
</body>
</html>
