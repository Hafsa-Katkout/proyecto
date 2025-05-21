<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Error de Autenticación</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body, html {
      height: 100%;
      width: 100%;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #000000, #1a1a1a, #ff0000, #0000ff);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      text-align: center;
      background-color: rgba(255, 255, 255, 0.12);
      border-radius: 20px;
      padding: 60px;
      backdrop-filter: blur(15px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      max-width: 700px;
      width: 90%;
      color: #fff;
    }

    h1 {
      font-size: 3rem;
      margin-bottom: 20px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 40px;
      line-height: 1.6;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .button-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .button-container button {
      padding: 16px 30px;
      font-size: 1rem;
      border: none;
      border-radius: 40px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
      background: linear-gradient(90deg, #ff0000, #000000, #0000ff);
      background-size: 200% 200%;
      color: white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    }

    .button-container button:hover {
      transform: translateY(-5px);
      animation: pulse 1s infinite alternate;
    }

    @keyframes pulse {
      from {
        background-position: 0% 50%;
      }
      to {
        background-position: 100% 50%;
      }
    }

    @media (max-width: 768px) {
      .container {
        padding: 30px;
      }

      .button-container {
        flex-direction: column;
      }

      .button-container button {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>¡Error de Autenticación!</h1>
    <p> Parece que los datos que introdujiste no son correctos. Verifica que tu nombre de usuario esté bien escrito y que la contraseña no tenga errores de mayúsculas o espacios.<br>
      Asegúrate de que el bloqueo de mayúsculas no esté activado y vuelve a intentarlo con cuidado.<br>
      Si no recuerdas tus credenciales, puedes restablecerlas o contactar con soporte. ¡Estamos aquí para ayudarte!</p>
    <div class="button-container">
      <button onclick="location.href='index.php'">Inicio</button>
      <button onclick="location.href='login.php'">Iniciar session</button>

      <button onclick="location.href='ayuda.html'">Ayuda</button>
    </div>
  </div>
</body>
</html>
