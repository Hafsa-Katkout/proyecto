<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control de Copias de Seguridad</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('images/dash.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
        }
        .container {
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h2 {
            font-size: 32px;
            margin-bottom: 25px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .backup-button {
            display: inline-block;
            margin: 15px;
            padding: 15px 40px;
            background-color: transparent;
            color: #fff;
            font-size: 18px;
            text-align: center;
            border: 2px solid #fff;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .backup-button:hover {
            background-color: #fff;
            color: #333;
            transform: translateY(-5px);
        }
        form {
            display: inline-block;
            margin: 15px 0;
        }
        .info-text {
            font-size: 16px;
            color: #d1d1d1;
            margin-top: 25px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Panel de Control</h2>

        <a href="backupMachine.php" class="backup-button">Copia de Seguridad en Cloud de tu Máquina Linux</a>

        <a href="updateMachine.php" class="backup-button">Copia de Seguridad en Cloud de tu Máquina Windows</a>
        
        

        <!-- BOTÓN NUEVO (LLEVA A UN HTML) -->
        <a href="updateMachine.php" class="backup-button">Actualizar tu Máquina Linux</a>


        <a href="usuarios_ansible.php" class="backup-button">Añadir usuarios en máquinas Linux</a>
        <a href="windows_espacio.php" class="backup-button">Comprobar espacio en disco en máquinas Windows</a>
        <a href="windows_update.php" class="backup-button">Actualización Remota de Máquinas Windows</a>

    </div>

</body>
</html>
