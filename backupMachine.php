<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "Hafsa@2005", "proyecto_db");

// Verificamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultamos todas las máquinas
$consulta = "SELECT * FROM datos";
$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de máquinas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/update.jpg') no-repeat center center fixed;
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




        table {
            width: 80%;
            margin: 40px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8);
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

        /* Efectos responsive */
        @media (max-width: 768px) {
            table {
                width: 95%;
            }

            .boton-agregar {
                width: 90%;
            }

            h2 {
                font-size: 2em;
            }
        }

    </style>
</head>
<body>

    <h2>Copia de Seguridad del Sistema Linux</h2>
    <h>Por favor, selecciona la máquina de la cual deseas realizar una copia de seguridad.
Este proceso guardará los datos del sistema en la nube para garantizar su disponibilidad y recuperación en caso de pérdida o fallo.
Si tienes alguna duda o necesitas asistencia, no dudes en ponerte en contacto con nosotros. Estamos para ayudarte.</h>

    <table>
        <tr>
            <th>ID</th>
            <th>Dirección IP</th>
            <th>Usuario</th>
            <th>Ruta de la clave</th>
            <th>Acciones</th>
        </tr>

        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['ip']; ?></td>
                    <td><?php echo $fila['usuario']; ?></td>
                    <td><?php echo $fila['ruta_clave']; ?></td>
                    <td>
                        <!-- Botón para ejecutar Playbook -->
                        <form action="ejecutar.php" method="post" style="display:inline;">
                            <input type="hidden" name="ip" value="<?php echo $fila['ip']; ?>">
                            <input type="hidden" name="usuario" value="<?php echo $fila['usuario']; ?>">
                            <input type="hidden" name="ruta_clave" value="<?php echo $fila['ruta_clave']; ?>">
                            <button type="submit" class="boton boton-play">Ejecutar Playbook</button>
                        </form>

                        <!-- Botón para editar -->
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

    <!-- Botón para añadir nueva máquina -->
    <a href="addMachine.php" class="boton-agregar">Añadir nueva máquina</a>
    <div class="botones-superiores">
        <a href="dashboard.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>
</body>
</html>
