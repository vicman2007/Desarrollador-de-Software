<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Administrador - Repostería Misves</title>
    <link rel="stylesheet" href="../../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../..//ASSETS/img/icon.png">
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
                <img src="../../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
            </a>
        </header>
        <nav>
            <div id="navHamb">
                <i class="fas fa-bars"></i>
            </div>
            <div id="navMenu">
                <a href="../../VIEW/usuario.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../../VIEW/producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../../VIEW/pedido/pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../../VIEW/reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../../VIEW/domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../../VIEW/estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas Diarias</a>
                <a href="../../VIEW/mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Productos Más Vendidos</a>
                <a href="../../VIEW/perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../../VIEW/Reportes.php"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../../index.html"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <h1 class="title">Mi Perfil - Administrador</h1>
            

  <div class="slider-auto">
    <img src="https://www.recetasnestle.cl/sites/default/files/styles/recipe_detail_desktop_new/public/srh_recipes/7997606364e3d951064009a8f0ded5c1.webp?itok=KmknvpJ5" class="active">
    <img src="https://www.recetasnestle.cl/sites/default/files/styles/recipe_detail_desktop_new/public/srh_recipes/1302363e83be81f0be9326ec040ad3a9.webp?itok=MumMHEDj">
    <img src="https://www.recetasnestle.cl/sites/default/files/styles/recipe_detail_desktop_new/public/srh_recipes/6a20f5c217ea950ae33221b7b18de535.webp?itok=Ixg3k6IH">
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