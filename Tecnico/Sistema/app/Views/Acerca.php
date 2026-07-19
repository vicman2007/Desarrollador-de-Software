<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home systems programming</title>
    <link rel="stylesheet" href="../ASSETS/CSS/styleHome.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/iconHome.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>
<style>
    header .container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 0;
    padding-right: 0;
    }   

    header .logo {
    margin: 0 auto;
    display: block;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* Texto degradado */
    .gradient-text {
      font-weight: bold;
      background: linear-gradient(to right, #9b9b9bff, #c7c7c7ff, #989898ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Menú informativo */
    .top-menu {
      background: linear-gradient(to right, #b4b4b4ff, #5a595cff, #8c9096ff);
      padding: 10px 0;
    }
    .top-menu ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
    }
    .top-menu ul li a {
      text-decoration: none;
      color: white;
      font-weight: bold;
      transition: 0.3s;
    }
    .top-menu ul li a:hover {
      opacity: 0.8;
    }

    /* Secciones */
    .section-page {
      text-align: center;
      padding: 50px 20px;
    }

    .titulo {
      font-size: 36px;
      margin-bottom: 20px;
    }

    /* Cards de integrantes */
    .contenedor-cards {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }
    .card-persona {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 280px;
      padding: 20px;
      text-align: center;
      transition: transform 0.3s;
    }
    .card-persona:hover {
      transform: scale(1.05);
    }
    .foto {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
    }
    .nombre {
      font-size: 20px;
      font-weight: bold;
      margin: 10px 0 5px;
    }
    .cargo, .email {
      font-size: 14px;
      color: #666;
    }
    .email {
      word-wrap: break-word;
      overflow-wrap: break-word;
      background: #f5f5f5;
      padding: 5px;
      border-radius: 5px;
    }

    /* Footer */
    footer {
      background-color: #f5f5f5;
      text-align: center;
      padding: 15px;
      font-size: 0.9rem;
      margin-top: auto;
    }
  </style>

<body>
    <header>
        <div class="container">
            <img src="../ASSETS/img/logoHome.png" class="logo">
        </div>
    </header>

    <nav id="mainNav">
        <div class="container">
            <a href="../indexHome.php" class="nav-item"><i class="fas fa-home"></i> Inicio</a>
            <a href="../VIEW/MisionYVision.php" class="nav-item"><i class="fas fa-bullseye"></i>Misión y Visión</a>
            <a href="../VIEW/Acerca.php" class="nav-item"><i class="fas fa-users"></i>Nosotros</a>
            <a href="../VIEW/Contacto.php" class="nav-item"><i class="fas fa-envelope"></i> Contacto</a>
            <a href="../VIEW/login.php" class="nav-item"><i class="fas fa-laptop-code"></i>Software Ventas</a>
        </div>
    </nav>

    <div class="content">
        <img src="../ASSETS/img/logoHome.png" alt="">
    </div>
    <br>
    <div class="contenedor-cards">
        <div class="card-persona">
          <img src="../ASSETS/img/victor.png" alt="victor" class="foto">
          <div class="nombre">Victor Solano</div>
          <div class="cargo">Dueño</div>
          <div class="email">solanoninov@gmail.com</div>
        </div>

        <div class="card-persona">
          <img src="../ASSETS/img/dylan.png" alt="dylan" class="foto">
          <div class="nombre">Dylan Cadena</div>
          <div class="cargo">Dueño</div>
          <div class="email">dylancadena2620@gmail.com</div>
        </div>
      </div>
    </section>
    </main>
    <main class="container">
        <main class="content">
            <h1><b><p>programamos tu sistema en la comodidad de tu casa</p></b></h1>
        </main>
        <br>
        <h2>VALORES</h2>
        <p>En nuestra empresa, actuamos con integridad y respeto, promoviendo un ambiente inclusivo y justo. Construimos relaciones basadas en la confianza y el compromiso a largo plazo, mientras nos sentimos responsables de contribuir al bien común y generar un impacto positivo en la sociedad.</p>
        <br>
        <h2>ALCANCE DEL PRODUCTO</h2>
        <p>Ofrecemos soluciones de software personalizadas que optimizan procesos empresariales, mejoran la experiencia del usuario y se adaptan a diversas industrias, garantizando crecimiento, integración y soporte continuo para cada cliente.
        </p>
        <br>
        <h2>OBJETIVO GENERAL</h2>
        <p>Desarrollar soluciones tecnológicas innovadoras y personalizadas que optimicen los procesos de negocio de nuestros clientes, mejoren su competitividad y faciliten su transformación digital, garantizando calidad y un impacto positivo a largo plazo.</p>
        <br>
        <h2>Quienes Somos</h2>
        <p>Somos una empresa comprometida en crear soluciones de software innovadoras y personalizadas, transformando el modo en que las empresas operan.  nos dedicamos a optimizar los procesos internos, mejorar la competitividad y facilitar la adaptación al mundo digital. A través de nuestra experiencia, ayudamos a nuestros clientes a afrontar sus retos de manera efectiva.  Con un enfoque en la excelencia, Nuestro enfoque es ofrecer soluciones que generen valor real, centradas en las necesidades de nuestros clientes y en el desarrollo sostenible a largo plazo.    
        </p>
    </main>

        <footer>
            <div class="container">
                <p>&copy; Derechos reservados de Home systems programming | 2024 | Bogota</p>
            </div>
        </footer>
        <a href="https://api.whatsapp.com/send/?phone=3134890742&text&type=phone_number&app_absent=0"
            id="whatsappButton" class="whatsapp-float">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <script src="../ASSETS/JS/script.js"></script>

</body>

</html>