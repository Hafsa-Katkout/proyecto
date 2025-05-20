<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar nueva máquina</title>
    <style>
        /* Fuente moderna desde Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&display=swap');

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-image: url('images/addupdate2.jpg'); /* Fondo cool */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            color: #444;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            font-weight: 500;
            background-color: rgba(255,255,255,0.8);
            margin-top: 15px;
            padding: 10px;
            border-radius: 8px;
            color: #333;
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
    <form method="post" action="">
        <h2>Insertar datos de tu nueva máquina</h2>
        <label for="ip">Dirección IP:</label>
        <input type="text" id="ip" name="ip" required>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="clave_privada">Clave Privada (formato texto):</label>
        <textarea id="clave_privada" name="clave_privada" rows="6" required></textarea>

        <input type="submit" value="Insertar máquina">
    </form>
    <div class="botones-superiores">
        <a href="updateMachine.php" class="boton-navegacion">Volver</a>
        <a href="logout.php" class="boton-navegacion">Cerrar sesión</a>
        <a href="ayuda.html" class="boton-navegacion">Ayuda</a>
    </div>
</body>
</html>
