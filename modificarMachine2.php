<?php
$servername = "localhost";
$username = "root";
$password = "Hafsa@2005"; 
$dbname = "proyecto_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $ip = $_POST['ip'];
    $usuario = $_POST['usuario'];
    $clave_privada = base64_encode($_POST['clave_privada']);
    $ruta_clave = $_POST['ruta_clave'];

  
    if (!empty($ip) && !empty($usuario) && !empty($clave_privada) && !empty($ruta_clave)) {
       
        $sql = "UPDATE datos SET ip = ?, usuario = ?, clave_privada = ?, ruta_clave = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $ip, $usuario, $clave_privada, $ruta_clave, $id);

        if ($stmt->execute()) {
        
            header("Location: updateMachine.php?status=success");
            exit();
        } else {

            $error_message = "Error al actualizar los datos: " . $stmt->error;
        }
    } else {
        $error_message = "Todos los campos deben estar completos.";
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM datos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $machine = $result->fetch_assoc();


    if (isset($machine['clave_privada'])) {
        $clave_codificada = $machine['clave_privada'];
        $clave = base64_decode($clave_codificada);
        $machine['clave_privada'] = $clave;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Máquina</title>
    <style>
  
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/modificar.jpg');
            background-size: cover;
            background-attachment: fixed;
            color: #333;
        }

    
        .container {
            width: 100%;
            max-width: 600px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            text-align: center;
            backdrop-filter: blur(10px); 
        }

    
        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #007BFF;
        }


        label {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }


        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

 
        input[type="text"]:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

      
        .success, .error {
            padding: 15px;
            margin-bottom: 20px;
            color: #fff;
            font-weight: bold;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .success {
            background-color: #28a745;
        }

        .error {
            background-color: #dc3545;
        }

       
        button {
            background-color: #007BFF;
            color: #fff;
            padding: 15px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

     
        @media screen and (max-width: 600px) {
            .container {
                width: 90%;
                padding: 20px;
            }
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
        <h2>Modificar Máquina</h2>

        <?php
        
        if (isset($error_message)) {
            echo "<div class='error'>$error_message</div>";
        }
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo "<div class='success'>Datos actualizados con éxito!</div>";
        }
        ?>

        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($machine['id']); ?>">

            <label for="ip">IP:</label>
            <input type="text" id="ip" name="ip" value="<?php echo htmlspecialchars($machine['ip']); ?>" required>

            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($machine['usuario']); ?>" required>

            <label for="clave_privada">Clave Privada:</label>
<textarea id="clave_privada" name="clave_privada" rows="10" style="width: 100%;" required><?php echo htmlspecialchars($machine['clave_privada']); ?></textarea>


            <label for="ruta_clave">Ruta Clave:</label>
            <input type="text" id="ruta_clave" name="ruta_clave" value="<?php echo htmlspecialchars($machine['ruta_clave']); ?>" required>

            <button type="submit">Actualizar Máquina</button>
        </form>
    </div>
    <div class="botones-superiores">
        <a href="updateMachine.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>

</body>
</html>

<?php
$conn->close();
?>
