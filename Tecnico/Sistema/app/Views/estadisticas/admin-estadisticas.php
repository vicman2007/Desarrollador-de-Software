<?php
require_once '../../MODEL/database.php';

$controller = 'Estadistica';
require_once "../../CONTROLLER/{$controller}Controller.php";

if(!isset($_REQUEST['u'])) {
    $controllerClass = $controller.'Controller';
    $controllerInstance = new $controllerClass;
    $controllerInstance->Index();
} else {
    $controller = strtolower($_REQUEST['u']);
    $accion = isset($_REQUEST['f']) ? $_REQUEST['f'] : 'Index';
    
    require_once "../../CONTROLLER/" . ucfirst($controller) . "Controller.php";
    $controllerClass = ucfirst($controller).'Controller';
    $controllerInstance = new $controllerClass;
    
    call_user_func(array($controllerInstance, $accion));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Diarias - Repostería Misves</title>
    <link rel="stylesheet" href="../../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="container-full">
        <header class="text-center">
            <a href="../../indexMisves.php">
                <img src="../../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
            </a>
        </header>
        <nav>
            <div id="navHamb">
                <i class="fas fa-bars"></i>
            </div>
            <div id="navMenu">
                <a href="../../VIEW/usuario.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../../VIEW/producto/admin-producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../../VIEW/pedido/admin-pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../../VIEW/reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../../VIEW/domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../../VIEW/estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas Diarias</a>
                <a href="../../VIEW/mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Productos Más Vendidos</a>
                <a href="../../VIEW/perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../../VIEW/Reportes.php"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../../indexHome.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <div class="section-header">
                <h1 class="title">Estadísticas de Domicilios</h1>
            </div>
            
            <div class="stats-container">
                <div class="stats-summary">
                    <div class="stat-card">
                        <i class="fas fa-truck"></i>
                        <h3>Hoy</h3>
                        <p class="stat-number">0</p>
                        <p>Domicilios</p>
                    </div>
                    
                    <div class="stat-card">
                        <i class="fas fa-calendar-week"></i>
                        <h3>Esta Semana</h3>
                        <p class="stat-number">0</p>
                        <p>Domicilios</p>
                    </div>
                    
                    <div class="stat-card">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>Este Mes</h3>
                        <p class="stat-number">0</p>
                        <p>Domicilios</p>
                    </div>
                    
                    <div class="stat-card">
                        <i class="fas fa-dollar-sign"></i>
                        <h3>Ingresos Hoy</h3>
                        <p class="stat-number">$0</p>
                        <p>Pesos</p>
                    </div>
                </div>
                
                <div class="daily-stats">
                    <h2>Domicilios por Día - Últimos 30 días</h2>
                    <div class="stats-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Domicilios</th>
                                    <th>Ingresos</th>
                                    <th>Promedio por Pedido</th>
                                </tr>
                            </thead>
                            <tbody id="daily-stats-tbody">
                                <!-- Los datos se cargarán dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="chart-section">
                    <h2>Gráfico de Tendencias</h2>
                    <div class="chart-container">
                        <canvas id="deliveryChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
    <script src="../../ASSETS/js/admin-estadisticas.js"></script>
</body>
</html>