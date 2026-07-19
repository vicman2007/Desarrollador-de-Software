<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Domiciliario - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
                <a href="../VIEW/domiciliario-perfil.php"><i class="fas fa-user"></i> Perfil</a>
            </div>
        </nav>
        
        <div class="content-full">
            <h1 class="title">Panel de Domiciliario</h1>
            
            <div class="domiciliario-menu">
                <div class="admin-card" onclick="location.href='domiciliario-productos.php'">
                    <i class="fas fa-birthday-cake"></i>
                    <h3>Productos Disponibles</h3>
                    <p>Ver todos los productos de la pastelería</p>
                </div>
                
                <div class="admin-card" onclick="location.href='domiciliario-entregas.php'">
                    <i class="fas fa-truck"></i>
                    <h3>Gestión de Domicilios</h3>
                    <p>Aceptar y realizar entregas</p>
                </div>
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
    <script src="../ASSETS/JS/domiciliario.js"></script>
</body>
</html>
