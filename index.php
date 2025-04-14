<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SysFero - Inicio</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    html, body {
      height: 100%;
      background: url('/images/p.inicio.jpg') no-repeat center center fixed;
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
        <li><a href="contacto.html">Contacto</a></li>
        <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
        <li><a href="porquenosotros.html">Porqué Nosotros</a></li>
        <li><a href="tutorial.html">Tutorial</a></li>
      </ul>
    </nav>

    <div class="hero-content">
      <h1>Deja que el mundo conozca SysFero</h1>
      <p>La plataforma inteligente para automatizar, gestionar y hacer crecer tu negocio como nunca antes.</p>
      <div class="hero-buttons">
        <a href="login.php">Iniciar Sesión</a>
        <a href="registro.php">Registrar</a>
      </div>
    </div>

    <div class="stats">
      <div>10+ Clientes Felices</div>
      <div>10+ Proyectos Activos</div>
      <div>12k+ Proyectos Completados</div>
    </div>
  </header>

  <section class="services">
    <h2>Nuestros Servicios</h2>
    <div class="service-icons">
      <div>
        <h4>Desarrollo Web</h4>
        <p>Sitios modernos y adaptables para tu empresa.</p>
      </div>
      <div>
        <h4>Google Ads</h4>
        <p>Campañas inteligentes para aumentar tus clientes.</p>
      </div>
      <div>
        <h4>SEO</h4>
        <p>Haz que te encuentren más fácilmente en la web.</p>
      </div>
      <div>
        <h4>Redes Sociales</h4>
        <p>Gestión y automatización para mayor presencia digital.</p>
      </div>
    </div>
  </section>

  <section class="why-choose">
    <h2>¿Por qué elegir SysFero?</h2>
    <div class="why-cards">
      <div class="card"><h3>Automatización total de procesos</h3></div>
      <div class="card"><h3>Integración con tus herramientas favoritas</h3></div>
      <div class="card"><h3>Soporte técnico en tiempo real</h3></div>
    </div>
  </section>

  <section class="bottom-section">
    <div class="bottom-left">
      <h3>Sobre nosotros</h3>
      <p>SysFero es una compañía enfocada en brindar soluciones digitales completas para empresas que desean optimizar su flujo de trabajo, conectar mejor con sus clientes y mantenerse a la vanguardia tecnológica.</p>
    </div>
    <div class="bottom-right">
      <img src="https://img.freepik.com/fotos-premium/doble-exposicion-holograma-dibujo-tema-datos-sobre-fondo-mesa-trabajo-vista-superior-concepto-tecnologia-computadora_700248-54978.jpg" alt="img1">
      <p>whatever</p>
      <img src="https://img.freepik.com/fotos-premium/doble-exposicion-manos-hombres-escribiendo-sobre-teclado-computadora-dibujo-hologramas-tema-tecnologico-vista-superior-concepto-tecnologico_700248-73023.jpg" alt="img2">
      <p>whatever</p>
    </div>
  </section>

  <section class="logo-section">
    <h3>Logo de SysFero</h3>
    <div class="logo-placeholder">Tu Logo Aquí</div>
  </section>
</body>
</html>
