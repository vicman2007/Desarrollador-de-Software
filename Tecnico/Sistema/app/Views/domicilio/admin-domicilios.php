<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Domicilios - Repostería Misves</title>
    <link rel="stylesheet" href="../../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .mensaje { padding: 15px; margin: 20px 0; border-radius: 5px; text-align: center; }
        .mensaje.exito { background-color: #d4edda; color: #155724; }
        .mensaje.error { background-color: #f8d7da; color: #721c24; }
        .filter-section { background: white; padding: 20px; border-radius: 10px; margin: 20px 0; display: flex; gap: 20px; }
        .filter-group { flex: 1; }
        .filter-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .filter-group select { width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 5px; }
        .summary-stats { display: flex; gap: 20px; margin: 20px 0; }
        .summary-item { background: white; padding: 20px; border-radius: 10px; text-align: center; flex: 1; }
        .summary-label { display: block; font-weight: bold; margin-bottom: 10px; }
        .summary-value { font-size: 2em; font-weight: bold; color: #f70c5b; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .btn { padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; margin: 2px; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-danger { background-color: #dc3545; color: white; }
        .estado-en_curso { color: #17a2b8; font-weight: bold; }
        .estado-entregado { color: #28a745; font-weight: bold; }
        .estado-cancelado { color: #dc3545; font-weight: bold; }
        .estado-realizado { color: #6c757d; font-weight: bold; }
        .estado-listo { color: #ffc107; font-weight: bold; }
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
                <a href="../../usuario.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../../producto/admin-producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../../pedido/admin-pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../../reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../../domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../../estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas Diarias</a>
                <a href="../../mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Productos Más Vendidos</a>
                <a href="../../perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../../Reportes.php"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../../indexHome.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <div class="section-header">
                <h1 class="title">Gestión de Domicilios</h1>
            </div>
            
            <?php if (isset($mensaje) && $mensaje): ?>
                <div class="mensaje <?php echo (strpos($mensaje, 'Error') !== false) ? 'error' : 'exito'; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            
            <div class="filter-section">
                <div class="filter-group">
                    <label for="status-filter">Filtrar por estado:</label>
                    <form method="GET" action="?u=domicilio&f=FiltrarPorEstado">
                        <select name="estado" onchange="this.form.submit()">
                            <option value="all">Todos</option>
                            <option value="listo" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'listo') ? 'selected' : ''; ?>>Listo</option>
                            <option value="en_curso" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'en_curso') ? 'selected' : ''; ?>>En curso</option>
                            <option value="entregado" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'entregado') ? 'selected' : ''; ?>>Entregado</option>
                            <option value="cancelado" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                        </select>
                    </form>
                </div>
            </div>
            
            <?php if (isset($resumen)): ?>
            <div class="delivery-summary">
                <h2>Resumen del Día</h2>
                <div class="summary-stats">
                    <div class="summary-item">
                        <span class="summary-label">Total Domicilios:</span>
                        <span class="summary-value"><?php echo $resumen['total_domicilios'] ?? 0; ?></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">En Curso:</span>
                        <span class="summary-value"><?php echo $resumen['en_curso'] ?? 0; ?></span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Entregados:</span>
                        <span class="summary-value"><?php echo $resumen['entregados'] ?? 0; ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="deliveries-list">
                <h2>Lista de Domicilios</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Cliente</th>
                            <th>Productos añadidos</th>
                            <th>Dirección</th>
                            <th>Fecha y Hora de Entrega</th>
                            <th>Forma de pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($domicilios) && !empty($domicilios)): ?>
                            <?php foreach($domicilios as $domicilio): ?>
                            <tr>
                                <td><?php echo $domicilio['idCarrito']; ?></td>
                                <td><?php echo htmlspecialchars($domicilio['nombreUsuario']); ?></td>
                                <td><?php echo htmlspecialchars($domicilio['productosAñadidos']); ?></td>
                                <td><?php echo htmlspecialchars($domicilio['DireccionEntrega']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($domicilio['FechaYHoraEntrega'])); ?></td>
                                <td><?php echo htmlspecialchars($domicilio['FormaPago']); ?></td>
                                <td class="estado-<?php echo $domicilio['Estado']; ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $domicilio['Estado'])); ?>
                                </td>
                                <td>
                                    <form method="POST" action="?u=domicilio&f=ActualizarEstado" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $domicilio['idCarrito']; ?>">
                                        <select name="estado" onchange="this.form.submit()">
                                            <option value="listo" <?php echo ($domicilio['Estado'] == 'listo') ? 'selected' : ''; ?>>Listo</option>
                                            <option value="en_curso" <?php echo ($domicilio['Estado'] == 'en_curso') ? 'selected' : ''; ?>>En Curso</option>
                                            <option value="entregado" <?php echo ($domicilio['Estado'] == 'entregado') ? 'selected' : ''; ?>>Entregado</option>
                                            <option value="cancelado" <?php echo ($domicilio['Estado'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" style="text-align: center;">No hay domicilios registrados</td>
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
