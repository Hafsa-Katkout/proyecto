<?php
session_start();
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario");
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: error-login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://www.tsc.edu/wp-content/uploads/2022/06/Texas-Southmost-College-computer-science-2-scaled.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
            width: 90%;
            height: 90%;
            border-radius: 20px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .left-section {
            flex: 2;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left-section h1 {
            font-size: 50px;
            color: #87CEEB;
        }

        .left-section h2 {
            font-size: 36px;
            font-weight: 800;
            margin: 10px 0;
        }

        .left-section p {
            max-width: 500px;
            margin-bottom: 30px;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        .buttons input[type="text"],
        .buttons input[type="password"] {
            padding: 15px 20px;
            font-size: 16px;
            width: 100%;
            border: 2px solid white;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            box-shadow: 0 0 10px white;
            margin-bottom: 15px;
        }

        .buttons input::placeholder {
            color: white;
            opacity: 0.9;
        }

        .buttons button {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .buttons .signin {
            background: #87CEEB;
            color: black;
        }

        .buttons .register {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .social-icons {
            margin-top: 20px;
            display: flex;
            gap: 15px;
            font-size: 20px;
        }

        .right-section {
    flex: 1;
    background: rgba(0, 0, 0, 0.6);
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    margin-top: -20px; /* Subtle upward shift */
}


        .company-name {
    font-size: 50px;
    font-weight: 800;
    color: #87CEEB; /* Light blue color */
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 5px;
    text-shadow: 2px 2px 6px rgba(255, 255, 255, 0.6), 0px 0px 15px rgba(0, 0, 0, 0.4); 
    margin: 20px auto 40px auto;
    padding: 10px 20px;
    border: 3px solid white; /* White border */
    border-radius: 10px; /* Rounded corners */
    transition: transform 0.3s ease-in-out;
}

.company-name:hover {
    transform: scale(1.1); /* Slight zoom effect on hover */
}

.menu {
    list-style: none;
    text-align: center;
    padding: 0;
    margin-top: -10px; /* Slight lift */
}

.menu li {
    margin: 15px 0;
}

.menu li a {
    text-decoration: none;
    color: white;
    width: 160px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
    border-radius: 25px;
    transition: 0.3s;
    margin: 0 auto;
}

.menu li a:hover {
    background-color: white;
    color: black;
}


        

        .bottom-icons {
            display: flex;
            gap: 20px;
            font-size: 24px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="left-section">
            <h1>Iniciar sesión</h1>
            <h2>Bienvenido a SysFero</h2>
            <p>Accede a tu cuenta para continuar. Si no tienes cuenta, ponte en contacto con los administradores.</p>
            <div class="buttons">
                <form method="POST" action="login.php">
                    <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de usuario" required>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    <button type="submit" class="signin">Iniciar sesión</button>
                </form>
                
            </div>
        </div>
        <div class="right-section">
    <div class="company-name">SysFero</div> 
    <ul class="menu">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="sobrenosotros.html">Sobre nosotros</a></li>
        <li><a href="servicios.html">Servicios</a></li>
        <li><a href="index.html">Contacto</a></li>
    </ul>
</div>
    </div>
</body>
</html>