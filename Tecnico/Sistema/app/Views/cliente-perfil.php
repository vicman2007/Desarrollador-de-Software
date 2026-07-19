<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
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
<body>
    <div class="container-full">
        <header class="text-center">
            <a href="../VIEW/indexMisves.php">
                <img src="../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
            </a>
        </header>
        <nav>
            <div id="navHamb">
                <i class="fas fa-bars"></i>
            </div>
            <div id="navMenu">
                <a href="../VIEW/indexMisves.php"><i class="fas fa-home"></i>Inicio</a>
                <a href="../VIEW/postres.php"><i class="fas fa-ice-cream"></i>Postres</a>
                <a href="../VIEW/mosaico.php"><i class="fas fa-th"></i>Mosaicos</a>
                <a href="../VIEW/cheesecake.php"><i class="fas fa-cheese"></i>Cheesecakes</a>
                <a href="../VIEW/tortas.php"><i class="fas fa-birthday-cake"></i>Tortas</a>
                <a href="../VIEW/cliente-perfil.php"><i class="fas fa-user"></i>Perfil</a>
                <a href="#" id="cart-icon"><i class="fas fa-shopping-cart"></i> Carrito</a>
            </div>
        </nav>
        
        <div class="content-full">
            <h1 class="title">Mi Perfil - Cliente</h1>
            

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
        
        <!-- Modal del Carrito -->
        <div id="cart-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Carrito de Compras</h2>
                
                <div class="cart-info">
                    <p><strong>Cliente:</strong> <span id="cart-cliente">Juan Pérez</span></p>
                    <p><strong>Dirección de Entrega:</strong> <span id="cart-direccion">Calle 123 #45-67, Bogotá</span></p>
                    <p><strong>Horario de Entrega:</strong> 
                        <select id="horario-entrega">
                            <option value="9-12">9:00 AM - 12:00 PM</option>
                            <option value="12-15">12:00 PM - 3:00 PM</option>
                            <option value="15-18">3:00 PM - 6:00 PM</option>
                            <option value="18-21">6:00 PM - 9:00 PM</option>
                        </select>
                    </p>
                    <p><strong>Forma de Pago:</strong> 
                        <select id="forma-pago">
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta de Crédito</option>
                            <option value="transferencia">Transferencia</option>
                        </select>
                    </p>
                </div>
                
                <div class="cart-products" id="cart-products">
                    <!-- Los productos se cargarán dinámicamente -->
                </div>
                
                <div class="cart-totals">
                    <p><strong>Subtotal:</strong> $<span id="subtotal">0</span></p>
                    <p><strong>Total a Pagar:</strong> $<span id="total">0</span></p>
                </div>
                
                <button class="btn-checkout">Realizar Pedido</button>
            </div>
        </div>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
    
    <div class="social-icons">
        <a href="https://www.instagram.com/misves_/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://api.whatsapp.com/send?phone=573214787249" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>

    <script src="../ASSETS/JS/cliente.js"></script>
</body>
</html>