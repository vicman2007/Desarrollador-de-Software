<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Pedidos - Repostería Misves</title>
    <link rel="icon" type="image/x-icon" href="../../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #f70c5b;
            --color-secondary: #ffb6c1;
            --color-white: #ffffff;
            --color-success: #28a745;
            --color-danger: #dc3545;
            --shadow-medium: 0 5px 15px rgba(0,0,0,0.15);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: linear-gradient(135deg, rgba(243,197,197,0.9), rgba(255,230,213,0.8)); font-family: Arial, sans-serif; min-height: 100vh; padding: 20px; }
        .container { max-width: 1400px; margin: 0 auto; }
        .logo { width: 200px; display: block; margin: 0 auto 20px; }
        nav { background: linear-gradient(135deg, var(--color-primary), #e60a50); padding: 15px; margin-bottom: 30px; border-radius: 15px; }
        #navMenu { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        nav a { color: var(--color-white); text-decoration: none; padding: 12px 18px; border-radius: 8px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; }
        nav a:hover { background-color: var(--color-white); color: var(--color-primary); }
        h2 { text-align: center; color: #e60a50; margin-bottom: 30px; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, var(--color-primary), #e60a50); color: var(--color-white); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(247,12,91,0.3); }
        .btn-success { background: var(--color-success); color: var(--color-white); font-size: 14px; padding: 8px 15px; }
        .btn-danger { background: var(--color-danger); color: var(--color-white); font-size: 14px; padding: 8px 15px; }
        .table-container { background: var(--color-white); border-radius: 15px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: linear-gradient(135deg, var(--color-primary), #e60a50); color: var(--color-white); padding: 15px; text-align: left; font-weight: 600; }
        td { padding: 12px 15px; border-bottom: 1px solid #f1f3f4; }
        tr:hover { background-color: #fef5f8; }
        .actions { display: flex; gap: 10px; }
        .footer { background: linear-gradient(135deg, var(--color-primary), #e60a50); color: var(--color-white); padding: 20px; text-align: center; margin-top: 40px; border-radius: 15px; }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <header>
        <img src="../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
    </header>

    <nav>
        <div id="navMenu">
            <a href="../usuario/admin-usuarios.php"><i class="fas fa-users"></i>Usuario</a>
            <a href="../producto/admin-producto.php"><i class="fas fa-birthday-cake"></i>Productos</a>
            <a href="../pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
            <a href="../reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
            <a href="../domicilio/admin-domicilios.php"><i class="fas fa-truck"></i>Domicilios</a>
            <a href="../estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas</a>
            <a href="../mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Más Vendidos</a>
            <a href="../perfil/admin-perfil.php"><i class="fas fa-user"></i>Perfil</a>
            <a href="../Reportes.php"><i class="fas fa-file-alt"></i>Reportes</a>
            <a href="../../indexHome.php"><i class="fas fa-home"></i>Salir</a>
        </div>
    </nav>

    <h2>Gestión de Pedidos</h2>

    <div class="table-container">
        <div class="header-actions">
            <h3>Lista de Pedidos</h3>
            <!-- Corregida la ruta para crear nuevo pedido -->
            <a href="?e=pedido&f=Editar" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Pedido
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Productos</th>
                    <th>Estado</th>
                    <th>Dirección</th>
                    <th>Fecha Entrega</th>
                    <th>Forma Pago</th>
                    <th>ID Usuario FK</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($pedidos) && count($pedidos) > 0): ?>
                    <?php foreach($pedidos as $pedido): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pedido->idCarrito); ?></td>
                            <td><?php echo htmlspecialchars($pedido->nombreUsuario); ?></td>
                            <td><?php echo htmlspecialchars($pedido->productosAñadidos); ?></td>
                            <td><?php echo htmlspecialchars($pedido->Estado); ?></td>
                            <td><?php echo htmlspecialchars($pedido->DireccionEntrega); ?></td>
                            <td><?php echo htmlspecialchars($pedido->FechaYHoraEntrega); ?></td>
                            <td><?php echo htmlspecialchars($pedido->FormaPago); ?></td>
                            <td><?php echo htmlspecialchars($pedido->idUsuarioFK); ?></td>
                            <td class="actions">
                                <!-- Corregidas las rutas de editar y eliminar -->
                                <a href="?e=pedido&f=Editar&idCarrito=<?php echo $pedido->idCarrito; ?>" class="btn btn-success">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="?e=pedido&f=Eliminar&idCarrito=<?php echo $pedido->idCarrito; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('¿Está seguro de eliminar este pedido?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 30px;">
                            <i class="fas fa-inbox" style="font-size: 48px; color: #ccc; display: block; margin-bottom: 10px;"></i>
                            No hay pedidos registrados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p><i class="fas fa-heart"></i> Derechos reservados Repostería Misves | 2024 | Bogotá</p>
    </footer>
</div>
</body>
</html>
