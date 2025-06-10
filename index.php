<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SysFero</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    html, body {
      height: 100%;
      background: url('/images/back1.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
      overflow-x: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.98);
      z-index: -1;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 10%;
      background: rgba(0, 0, 0, 0.85);
      position: sticky;
      top: 0;
      z-index: 10;
      backdrop-filter: blur(6px);
      box-shadow: 0 0 20px rgba(0,0,0,0.9);
    }

    nav .logo {
      font-size: 24px;
      font-weight: bold;
      color: white;
      text-shadow: 0 0 10px white;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
      text-shadow: none;
    }

    nav ul li a:hover {
      color: skyblue;
    }

    .hero-content {
      text-align: center;
      color: white;
      padding-top: 60px;
    }

    .hero-content h1 {
      font-size: 48px;
      font-weight: bold;
      margin-bottom: 20px;
      color: white;
      text-shadow: 0 0 12px white;
    }

    .hero-content p {
      font-size: 18px;
      max-width: 600px;
      margin: 0 auto 30px;
      color: white;
      text-shadow: 0 0 8px white;
    }

    .hero-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .hero-buttons a {
      padding: 12px 24px;
      font-size: 16px;
      border-radius: 6px;
      background-color: rgba(255, 255, 255, 0.15);
      color: black;
      border: 1px solid white;
      text-decoration: none;
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.9);
      transition: background-color 0.3s, color 0.3s;
      backdrop-filter: blur(10px);
      text-shadow: 0 0 8px white;
    }

    .hero-buttons a:hover {
      background-color: skyblue;
      color: white;
    }

    .stats,
    section,
    .why-cards .card,
    .bottom-right,
    .bottom-left,
    .logo-section {
      background-color: rgba(255, 255, 255, 0.08);
      color: white;
      padding: 20px;
      border-radius: 10px;
      backdrop-filter: blur(15px);
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.9);
    }

    .stats h3,
    .why-cards .card h3,
    .bottom-left h3,
    .logo-section h3,
    .services h2,
    .why-choose h2 {
      color: white;
      text-shadow: 0 0 10px white;
    }

    .stats {
      display: flex;
      justify-content: space-around;
      margin: 40px 10%;
      text-shadow: none;
    }

    .stats div {
      font-weight: bold;
      color: white;
      text-shadow: none;
    }

    section {
      margin: 40px 10%;
    }

    h2, h3 {
      text-align: center;
    }

    .service-icons {
      display: flex;
      justify-content: space-between;
      text-align: center;
      margin-top: 40px;
    }

    .service-icons div {
      width: 22%;
      color: white;
      text-shadow: none;
    }

    .why-cards {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    .why-cards .card {
      width: 30%;
      color: white;
      text-shadow: none;
    }

    .bottom-section {
      display: flex;
      justify-content: space-between;
      gap: 40px;
      margin: 40px 10%;
    }

    .bottom-right img {
      width: 100%;
      border-radius: 12px;
      margin-bottom: 10px;
    }

    .bottom-right p {
      text-align: center;
      font-style: italic;
      color: white;
      text-shadow: none;
    }

    .bottom-left p {
      color: white;
      text-shadow: none;
    }

    .logo-section {
      text-align: center;
      margin: 40px 10%;
      color: white;
      text-shadow: none;
    }

    .logo-placeholder {
      width: 200px;
      height: 100px;
      margin: 0 auto;
      background: #ccc;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo">SysFero</div>
      <ul>
        <li><a href="servicios.html">Servicios</a></li>
        <li><a href="index.html">Contacto</a></li>
        <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
        <li><a href="porquenosotros.html">Porqué Nosotros</a></li>
        <li><a href="tutorial.html">Tutorial</a></li>
      </ul>
    </nav>

    <div class="hero-content">
      <h1>¿Quién Dijo que no Puedes Controlarlo Todo? Descúbrelo con SysFero</h1>
      <p>La plataforma inteligente para automatizar, gestionar y hacer crecer tu negocio como nunca antes.</p>
      <div class="hero-buttons">
        <a href="login.php">Iniciar Sesión</a>

      </div>
    </div>

    <div class="stats">
      <div>Innovación Continua</div>
      <div>Seguridad y Confiabilidad</div>
      <div>Experiencia de Usuario Excepcional</div>
    </div>
  </header>

  <section class="services">
    <h2>Servicios de nuestra plataforma SysFero</h2>
    <div class="service-icons">
      <div>
        <h4>Control Remoto</h4>
        <p>Permite gestionar y administrar dispositivos de manera remota, ahorrando tiempo y recursos al permitir el acceso desde cualquier ubicación.</p>
      </div>
      <div>
        <h4>Gestión en la Nube</h4>
        <p>Centraliza la administración de dispositivos en la nube, simplificando el control y monitoreo sin necesidad de infraestructura física.</p>
      </div>
      <div>
        <h4>Automatización de Tareas</h4>
        <p>Automatiza tareas recurrentes, mejorando la eficiencia y reduciendo los errores humanos en la configuración y mantenimiento de sistemas.</p>
      </div>
      <div>
        <h4>Monitoreo en Tiempo Real</h4>
        <p>Permite supervisar el estado de los dispositivos al instante, enviando alertas sobre posibles fallos o problemas para una respuesta rápida.</p>
      </div>
    </div>
  </section>

  <section class="why-choose">
    <h2>¿Por qué elegir SysFero?</h2>
    <div class="why-cards">
      <div class="card"><h3>Multiplataforma y Versatilidad</h3></div>
      <div class="card"><h3>Gestión Centralizada en la Nube</h3></div>
      <div class="card"><h3>Interfaz Intuitiva y Fácil de Usar</h3></div>
      <div class="card"><h3>Enfoque en las Necesidades de cada Cliente</h3></div>
      
    </div>
  </section>

  <section class="bottom-section">
    <div class="bottom-left">
      <h3>Sobre nosotros</h3>
      <p>Sysfero es una empresa de consultoría tecnológica que ayuda a pequeñas y medianas empresas a simplificar su infraestructura informática, ofreciendo soluciones personalizadas en Ciberseguridad, Mantenimiento de redes, Administración de sistemas, y más. Con sede en Torrelavega, Cantabria, nos destacamos por adaptar nuestros servicios a las necesidades específicas de cada cliente, brindando Soporte técnico 24/7 y gestionando copias de seguridad en la nube.<br><br>

Uno de nuestros desarrollos clave es una Plataforma web que permite gestionar de forma remota máquinas con Linux, Windows y routers Cisco con una interfaz fácil de usar, ideal para empresas que buscan control sin conocimientos técnicos avanzados.<br><br>

Nos comprometemos con la Innovación, el Desarrollo local, y la Responsabilidad ambiental, ofreciendo soluciones eficientes y seguras para empresas que buscan crecer con confianza en un entorno digital.</p>
    </div>
    <div class="bottom-right">
      <img src="https://img.freepik.com/vector-gratis/diseno-plano-infografia-empresarial-foto_52683-20581.jpg?uid=R135752407&ga=GA1.1.1981654414.1743412727&w=740" alt="img1">
      <p>La empresa Sysfero</p>
      <img src="images/logo.png" alt="img2">
      <p>Logo de SysFero</p>
    </div>
  </section>

  <section class="logo-section">
  <h3>Aviso importante:</h3>
  <p>Esta aplicación ha sido desarrollada únicamente con fines educativos como parte de un proyecto final del Ciclo Formativo de Grado Superior en Administración de Sistemas Informáticos en Red (ASIR). No se trata de un servicio comercial ni se ofrece para uso profesional o empresarial.<br><br>
  La finalidad de esta plataforma es exclusivamente de prueba y aprendizaje. No requiere certificados oficiales ni licencias comerciales, ya que no se encuentra destinada a la explotación pública.</p>
  </section>
</body>
</html>
