<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2>Panel de control de copias de seguridad</h2>

    <form action="ejecutar.php" method="get">
        <input type="hidden" name="tipo" value="linux">
        <button type="submit">Backup Linux</button>
    </form>

    <form action="ejecutar.php" method="get">
        <input type="hidden" name="tipo" value="windows">
        <button type="submit">Backup Windows</button>
    </form>

</body>
</html>
