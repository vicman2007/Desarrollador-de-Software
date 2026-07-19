<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Entregas - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
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
                <a href="../VIEW/domiciliario-productos.php"><i class="fas fa-birthday-cake"></i>Productos Disponibles</a>
                <a href="../VIEW/domiciliario-entregas.php"><i class="fas fa-truck"></i>Gestión de Domicilios</a>
                <a href="../VIEW/domiciliario-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../VIEW/login.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <div class="section-header">
                <h1 class="title">Gestión de Entregas</h1>
            </div>
            
            <div class="deliveries-container">
                <h2>Domicilios Disponibles</h2>
                <div class="deliveries-list" id="deliveries-list">
                    
                </div>
                
                <h2>Mis Entregas en Curso</h2>
                <div class="active-deliveries" id="active-deliveries">
                    <!-- Las entregas activas se mostrarán aquí -->
                </div>
            </div>
        </div>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
    <script src="../ASSETS/JS/domiciliario.js"></script>
</body>
</html>