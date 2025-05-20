<?php
include 'dbconfig.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario");
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch();

    if ($usuario) {
        $error = "El nombre de usuario ya está en uso.";
    } else {
        $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, email) VALUES (:nombre_usuario, :contrasena, :email)");
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro</title>
  <style>
    /* Pegado directamente el CSS del segundo archivo (puedes separarlo si quieres) */
    * { box-sizing: border-box; }
    body, html { margin: 0; padding: 0; height: 100%; font-family: Arial, sans-serif; }
    .background {
      background-image: url('https://img.freepik.com/foto-gratis/oficina-negocios-vacia-bien-equipada-computadoras-utilizadas-proceso-contratacion_482257-102943.jpg');
      background-size: cover; background-position: center; height: 100vh;
      position: relative; padding: 40px; display: flex; flex-direction: column; color: white;
    }
    .gradient-overlay {
      position: absolute; top: 0; left: 0; height: 100%; width: 100%;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); z-index: 1;
    }
    .white-button {
  padding: 12px 25px;
  font-size: 16px;
  display: inline-block;
  border: 2px solid white;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s, color 0.3s;
  box-shadow: 0 0 5px white;
  text-align: center;
  height: 45px;
  background: transparent;       
  cursor: pointer;               
}
.white-button:hover {
  background-color: #87CEEB;
  color: white;
}
    .inicio-button { position: absolute; top: 20px; left: 30px; z-index: 3; width: 200px; }
    .ayuda-button { width: 200px; }
    .content {
      position: relative; z-index: 2; display: flex; justify-content: space-between;
      align-items: center; width: 100%; max-width: 1400px; margin: auto; margin-top: 20px; gap: 50px;
    }
    .left-side {
      max-width: 45%; padding: 30px; display: flex; flex-direction: column;
      justify-content: center; margin-top: 0;
    }
    .left-side h1 { font-size: 60px; margin: 0; }
    .highlight { color: #87CEEB; }
    .left-side hr {
      width: 400px; border: 2px solid #87CEEB; margin: 20px 0 10px 0;
    }
    .small-text { font-size: 16px; color: white; margin-bottom: 20px; }
    .right-box {
      background-color: rgba(0, 0, 0, 0.6); padding: 50px; border-radius: 15px;
      width: 470px; text-align: left; color: white; display: flex; flex-direction: column;
      justify-content: center; margin-left: -120px; transform: translateX(-20px);
    }
    .main-title { font-size: 36px; margin-bottom: 10px; }
    .description { font-size: 16px; color: #ccc; margin-bottom: 25px; }
    .input-label {
      display: block; margin-top: 15px; margin-bottom: 5px;
      font-weight: bold; font-size: 14px; color: #87CEEB;
    }
    .input-field {
      width: 100%; padding: 12px; border: none; border-radius: 5px;
      margin-bottom: 10px; font-size: 14px;
    }
    .action-buttons { display: flex; gap: 20px; margin-top: 25px; }
    .action-buttons .white-button {
      flex: 1; text-align: center; font-size: 16px; padding: 12px;
    }
    @media screen and (max-width: 1000px) {
      .content { flex-direction: column; align-items: flex-start; }
      .left-side, .right-box { max-width: 100%; width: 100%; }
      .right-box { margin-left: 0; transform: none; margin-top: 30px; }
    }
  </style>
</head>
<body>
  <div class="background">
    <div class="gradient-overlay"></div>
    <a href="index.php" class="white-button inicio-button">Inicio</a>

    <div class="content">
      <div class="left-side">
        <h1>Domina <span class="highlight">SysFero </span>y controla todo</h1>
        <hr />
        <p class="small-text">En esta sección puedes registrar los datos del nuevo controlador de la aplicación.
Ten en cuenta que al conceder acceso, asumes toda la responsabilidad sobre el uso que esta persona haga del sistema. Añadir a alguien no autorizado podría representar un riesgo para la seguridad y estabilidad del servicio.</p>
        <a href="ayuda.html" class="white-button ayuda-button">Ayuda</a>
      </div>

      <div class="right-box">
        <h2 class="main-title">Nuevo usuario</h2>
        <p class="description">Información del Usuario a Registrar...</p>
        <form method="POST" action="registro.php">
          <label class="input-label" for="nombre_usuario">Nombre de usuario</label>
          <input class="input-field" type="text" name="nombre_usuario" id="nombre_usuario" required>

          <label class="input-label" for="contrasena">Contraseña</label>
          <input class="input-field" type="password" name="contrasena" id="contrasena" required>

          <label class="input-label" for="email">Correo electrónico</label>
          <input class="input-field" type="email" name="email" id="email" required>

          <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

          <div class="action-buttons">
            <button type="submit" class="white-button">Registrarse</button>
            <a href="login.php" class="white-button">Iniciar sesión</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
