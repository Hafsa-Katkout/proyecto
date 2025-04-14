<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sysfero - Proyecto de Aplicación</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('https://img.freepik.com/foto-gratis/concepto-negocio-equipo-cerca_23-2149151159.jpg?t=st=1744474265~exp=1744477865~hmac=b42b20c8cec6989813d53932375857a29f592709db49a62eca33b00f621a8c1e&w=1380') no-repeat center center fixed;
      background-size: cover;
      color: white;
      padding: 40px;
    }

    .overlay {
      background-color: rgba(10, 20, 40, 0.85);
      padding: 40px;
      border-radius: 20px;
    }

    h1 {
      font-size: 32px;
      margin-bottom: 10px;
      color: #66bfff;
    }

    h2 {
      font-size: 20px;
      margin-bottom: 25px;
      color: #aad4ff;
      font-weight: normal;
    }

    p {
      font-size: 15px;
      line-height: 1.6;
      margin-bottom: 15px;
      text-align: justify;
    }

    ul {
      margin-left: 20px;
      font-size: 14px;
    }

    strong {
      color: #99ccff;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <h1>Sysfero</h1>
    <h2>Impulsamos tu infraestructura, automatizamos tu futuro</h2>

    <p><strong>Sysfero</strong> nace con el objetivo de ofrecer soluciones tecnológicas avanzadas para empresas que desean modernizar y automatizar sus infraestructuras informáticas. La empresa se enfoca en proporcionar servicios de instalación, mantenimiento, y automatización de sistemas tanto en entornos locales como remotos.</p>

    <p>El corazón del proyecto es una aplicación web desarrollada íntegramente en <strong>PHP</strong>, diseñada para permitir el <strong>control remoto de sistemas Linux, Windows y routers Cisco</strong>. A través de una interfaz sencilla y segura, los usuarios pueden conectarse a sus máquinas, ejecutar tareas automatizadas y gestionar configuraciones desde cualquier lugar.</p>

    <p>La automatización se lleva a cabo mediante el uso de <strong>Ansible</strong>, una potente herramienta de gestión de configuraciones y orquestación. Cada tipo de sistema (Ubuntu, Windows, Cisco) cuenta con sus propios <strong>playbooks</strong> adaptados, garantizando compatibilidad y eficiencia.</p>

    <p>Las principales funcionalidades de la aplicación incluyen:</p>
    <ul>
      <li>Autenticación de usuarios con control de acceso.</li>
      <li>Ejecución de tareas automatizadas según el sistema detectado.</li>
      <li>Creación y gestión de <strong>copias de seguridad en la nube</strong>.</li>
      <li>Interfaz visual clara, con botones que activan los playbooks de Ansible según el objetivo deseado.</li>
      <li>Registro y monitoreo de acciones realizadas.</li>
    </ul>

    <p>Desde el momento en que el usuario accede, el sistema verifica su autenticación. Si no es válido, se le redirige a una página de error o advertencia. Si el acceso es correcto, se muestra un panel con los botones de acción correspondientes (por ejemplo, realizar backup, reiniciar servicios, consultar estado).</p>

    <p>Este proyecto no solo representa una solución práctica para empresas, sino también una muestra de cómo se puede integrar el desarrollo web con herramientas DevOps para crear una plataforma robusta y profesional.</p>
  </div>
</body>
</html>
