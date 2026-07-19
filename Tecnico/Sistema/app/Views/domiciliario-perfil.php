<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Domiciliario - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>

         /* SLIDER AUTOMÁTICO */
    .slider-auto {
      position: relative;
      max-width: 1200px;
      margin: auto;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .slider-auto img {
      width: 100%;
      display: none;
    }

    .slider-auto img.active {
      display: block;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    </style>
</head>
<body>
    <div class="container-full">
        <header class="text-center">
                <img src="../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
        </header>
        <nav>
            <div id="navHamb">
                <i class="fas fa-bars"></i>
            </div>
            <div id="navMenu">
                <a href="../VIEW/domiciliario-productos.php"><i class="fas fa-birthday-cake"></i>Productos Disponibles</a>
                <a href="../VIEW/domiciliario-entregas.php"><i class="fas fa-truck"></i>Gestión de Domicilios</a>
                <a href="../VIEW/domiciliario-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../VIEW/login.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <h1 class="title">Mi Perfil - Domiciliaro</h1>
            

  <div class="slider-auto">
    <img src="https://marketing4ecommerce.co/wp-content/uploads/2020/06/apps-de-reparto.jpg" class="active">
    </div>
        </div>

    
    <script>
  
    let indexAuto = 0;
    const imagesAuto = document.querySelectorAll(".slider-auto img");

    function showSlidesAuto() {
      imagesAuto.forEach(img => img.classList.remove("active"));
      indexAuto = (indexAuto + 1) % imagesAuto.length;
      imagesAuto[indexAuto].classList.add("active");
    }
    setInterval(showSlidesAuto, 3000); 
    
  </script>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
</body>
</html>