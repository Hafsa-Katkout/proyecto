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
            background-image: url('images/dash.jpg'); /* High-quality background image */
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
        <h2>Panel de Control de Copias de Seguridad</h2>

        <form action="ejecutar.php" method="get">
            <input type="hidden" name="tipo" value="linux">
            <button type="submit" class="backup-button">Backup Linux</button>
        </form>

        <form action="ejecutar.php" method="get">
            <input type="hidden" name="tipo" value="windows">
            <button type="submit" class="backup-button">Backup Windows</button>
        </form>

        <div class="info-text">
            <p>Elige el sistema para realizar una copia de seguridad remota en la nube.</p>
        </div>
    </div>

</body>
</html>
