<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tortas - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <style>
        .content {
            height: auto;
            width: 1100px;
        }
        body {
            background: url(/ASSETS/img/bg.jpg);
            font-family: var(--font-main);
            color: var(--color-text);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
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
        <div class="content">
            <div class="text-center">
                <img src="../ASSETS/img/banner tortas.png" alt="Banner Tortas" class="content">
            </div>
            <h1 class="title">Tortas</h1>
            <div class="productos">
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/chooreo.jpeg" alt="Torta de chooreo" class="product-image">
                    <h2>Torta de chooreo</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/choco.jpeg" alt="Torta de chocolate" class="product-image">
                    <h2>Torta de chocolate</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/masmelos.jpeg" alt="Torta de masmelos" class="product-image">
                    <h2>Torta de masmelos</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/fruta encapsulada durazno.jpeg" alt="encapsulado de durazno" class="product-image">
                    <h2>Encapsulado de durazno</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/fruta encapsulada maracu.jpeg" alt="encapsulado de maracuya" class="product-image">
                    <h2>Encapsulado de maracuya</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/encapsulada.jpeg" alt="encapsulado de fruta" class="product-image">
                    <h2>Encapsulado de fruta</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/fresa con barquillos.jpeg" alt="torta de fresa y barquillos" class="product-image">
                    <h2>Torta con fresa y barquillos</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/gomitas.jpeg" alt="torta gomitas y barquillos" class="product-image">
                    <h2>Torta con gomitas y barquillos</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/esponjado maracu.jpeg" alt="Esponjado de maracuya" class="product-image">
                    <h2>Esponjado de maracuya<h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/encapsulado de fresa.jpeg" alt="encapsulado de fresa" class="product-image">
                    <h2>Encapsulado de fresa</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <div class="product-card" data-tilt>
                    <img src="../ASSETS/img/m y m.jpeg" alt="Torta de m&m´s y barquillos" class="product-image">
                    <h2>Torta de m&m´s y barquillos</h2>
                    <h3>$ 50.000</h3>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                <!-- Add more product cards for other cakes -->
            </div>
        </div>
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
    <script src="../ASSETS/JS/app.js "></script>
    <script src="../ASSETS/JS/cliente.js"></script>  
</body>
</html>