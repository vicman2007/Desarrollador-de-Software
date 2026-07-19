<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Más Vendidos - Repostería Misves</title>
    <link rel="stylesheet" href="../../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .mensaje { padding: 15px; margin: 20px 0; border-radius: 5px; text-align: center; }
        .mensaje.exito { background-color: #d4edda; color: #155724; }
        .mensaje.error { background-color: #f8d7da; color: #721c24; }
        .period-selector { background: white; padding: 20px; border-radius: 10px; margin: 20px 0; }
        .period-selector label { font-weight: bold; margin-right: 10px; }
        .period-selector select { padding: 10px; border: 2px solid #ddd; border-radius: 5px; }
        .ranking-list { background: white; padding: 20px; border-radius: 10px; margin: 20px 0; }
        .ranking-item { display: flex; align-items: center; padding: 15px; border-bottom: 1px solid #eee; }
        .ranking-position { font-size: 2em; font-weight: bold; color: #f70c5b; margin-right: 20px; min-width: 50px; }
        .ranking-info { flex: 1; }
        .ranking-name { font-weight: bold; font-size: 1.2em; margin-bottom: 5px; }
        .ranking-stats { color: #666; }
        .ranking-sales { font-weight: bold; color: #28a745; margin-left: auto; font-size: 1.1em; }
        .top-3 { background: linear-gradient(45deg, #ffd700, #ffed4e); }
        .top-5 { background: linear-gradient(45deg, #c0c0c0, #e8e8e8); }
        .top-10 { background: linear-gradient(45deg, #cd7f32, #daa520); }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container-full">
        <header class="text-center">
            <img src="../../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
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
                <h1 class="title">Productos Más Vendidos</h1>
            </div>
            
            <?php if (isset($mensaje) && $mensaje): ?>
                <div class="mensaje <?php echo (strpos($mensaje, 'Error') !== false) ? 'error' : 'exito'; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            
            <div class="period-selector">
                <label for="period">Período:</label>
                <form method="POST" action="?u=masvendidos&f=ObtenerPorPeriodo" style="display: inline;">
                    <select name="periodo" onchange="this.form.submit()">
                        <option value="week" <?php echo (isset($_POST['periodo']) && $_POST['periodo'] == 'week') ? 'selected' : ''; ?>>Esta semana</option>
                        <option value="month" <?php echo (!isset($_POST['periodo']) || $_POST['periodo'] == 'month') ? 'selected' : ''; ?>>Este mes</option>
                        <option value="year" <?php echo (isset($_POST['periodo']) && $_POST['periodo'] == 'year') ? 'selected' : ''; ?>>Este año</option>
                    </select>
                </form>
            </div>
            
            <div class="bestsellers-ranking">
                <h2>Ranking de Productos</h2>
                <div class="ranking-list">
                    <?php if (isset($masVendidos) && !empty($masVendidos)): ?>
                        <?php $posicion = 1; ?>
                        <?php foreach($masVendidos as $producto): ?>
                            <div class="ranking-item <?php 
                                if($posicion <= 3) echo 'top-3';
                                elseif($posicion <= 5) echo 'top-5';
                                elseif($posicion <= 10) echo 'top-10';
                            ?>">
                                <div class="ranking-position"><?php echo $posicion; ?></div>
                                <div class="ranking-info">
                                    <div class="ranking-name"><?php echo htmlspecialchars($producto['NombreProducto']); ?></div>
                                    <div class="ranking-stats">
                                        Vendidos: <?php echo $producto['total_vendidos']; ?> unidades | 
                                        Precio: $<?php echo number_format($producto['Precio'], 2); ?>
                                    </div>
                                </div>
                                <div class="ranking-sales">
                                    $<?php echo number_format($producto['ingresos_totales'], 2); ?>
                                </div>
                            </div>
                            <?php $posicion++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; padding: 20px;">No hay datos de ventas para el período seleccionado</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="sales-table">
                <h2>Detalle de Ventas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Posición</th>
                            <th>Producto</th>
                            <th>Unidades Vendidas</th>
                            <th>Precio Unitario</th>
                            <th>Ingresos Totales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($masVendidos) && !empty($masVendidos)): ?>
                            <?php $posicion = 1; ?>
                            <?php foreach($masVendidos as $producto): ?>
                            <tr>
                                <td><?php echo $posicion; ?></td>
                                <td><?php echo htmlspecialchars($producto['NombreProducto']); ?></td>
                                <td><?php echo $producto['total_vendidos']; ?></td>
                                <td>$<?php echo number_format($producto['Precio'], 2); ?></td>
                                <td>$<?php echo number_format($producto['ingresos_totales'], 2); ?></td>
                            </tr>
                            <?php $posicion++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No hay datos disponibles</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
</body>
</html>
