<?php
require_once __DIR__ . '/../../CONTROLLER/ReseñaController.php';

$reseñaController = new ReseñaController();

// Buscar por ID si se envía un parámetro
if (isset($_GET['idReseña']) && !empty($_GET['idReseña'])) {
    $resenas = $reseñaController->buscarResena($_GET['idReseña']);
} else {
    // Listar todas si no se busca
    $resenas = $reseñaController->listarResenas();
}

// Validar que siempre sea array
if (!is_array($resenas)) {
    $resenas = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reseñas - Repostería Misves</title>
    <link rel="stylesheet" href="../../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .mensaje { padding: 15px; margin: 20px 0; border-radius: 5px; text-align: center; }
        .mensaje.exito { background-color: #d4edda; color: #155724; }
        .mensaje.error { background-color: #f8d7da; color: #721c24; }
        .reviews-filter { display: flex; gap: 20px; margin: 20px 0; align-items: center; }
        .filter-group { display: flex; flex-direction: column; }
        .filter-group label { font-weight: bold; margin-bottom: 5px; }
        .filter-group select { padding: 8px; border-radius: 5px; border: 1px solid #ddd; }
        .reviews-stats { display: flex; gap: 20px; margin: 20px 0; }
        .stat-card { background: white; padding: 20px; border-radius: 10px; text-align: center; flex: 1; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-number { font-size: 2em; font-weight: bold; color: #f70c5b; }
        .reviews-grid, .approved-reviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin: 20px 0; }
        .review-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .review-header { display: flex; justify-content: between; align-items: center; margin-bottom: 10px; }
        .review-rating { color: #ffc107; }
        .review-product { font-weight: bold; color: #f70c5b; }
        .review-text { margin: 10px 0; line-height: 1.5; }
        .review-actions { display: flex; gap: 10px; margin-top: 15px; }
        .btn { padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-warning { background-color: #ffc107; color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        tr:hover { background-color: #f5f5f5; }
    </style>
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
                <a href="../usuario.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../producto/admin-producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../pedido/admin-pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas Diarias</a>
                <a href="../mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Productos Más Vendidos</a>
                <a href="../perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../Reportes.php"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../indexHome.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <div class="section-header">
                <h1 class="title">Gestión de Reseñas</h1>
            </div>
            
            <?php if (isset($mensaje) && $mensaje): ?>
                <div class="mensaje <?php echo (strpos($mensaje, 'Error') !== false) ? 'error' : 'exito'; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>
            
            <div class="reviews-container">
                <div class="reviews-filter">
                    <div class="filter-group">
                        <label for="rating-filter">Filtrar por Calificación:</label>
                        <select id="rating-filter" onchange="filtrarPorCalificacion()">
                            <option value="all">Todas las calificaciones</option>
                            <option value="5">5 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="2">2 estrellas</option>
                            <option value="1">1 estrella</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="product-filter">Filtrar por Producto:</label>
                        <select id="product-filter" onchange="filtrarPorProducto()">
                            <option value="all">Todos los productos</option>
                            <?php if (isset($productos) && !empty($productos)): ?>
                                <?php foreach($productos as $producto): ?>
                                    <option value="<?php echo $producto['CodProducto']; ?>">
                                        <?php echo htmlspecialchars($producto['NombreProducto']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                
                <?php if (isset($estadisticas)): ?>
                <div class="reviews-stats">
                    <div class="stat-card">
                        <h3>Total Reseñas</h3>
                        <p class="stat-number"><?php echo $estadisticas['total_resenas'] ?? 0; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Promedio</h3>
                        <p class="stat-number"><?php echo number_format($estadisticas['promedio_calificacion'] ?? 0, 1); ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Positivas</h3>
                        <p class="stat-number"><?php echo $estadisticas['positivas'] ?? 0; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Negativas</h3>
                        <p class="stat-number"><?php echo $estadisticas['negativas'] ?? 0; ?></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="reviews-list">
                    <h2>Todas las Reseñas</h2>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Calificación</th>
                                <th>Observación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php if (!empty($resenas)) : ?>
                <?php foreach ($resenas as $resena) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($resena['idReseña']); ?></td>
                        <td><?php echo htmlspecialchars($resena['CalificacionProducto']); ?></td>
                        <td><?php echo htmlspecialchars($resena['ObservacionProducto']); ?></td>
                        <td><?php echo htmlspecialchars($resena['CodProductoFK']); ?></td>
                        <td>
                            <a href="resena-editar.php?id=<?php echo $resena['id']; ?>">Editar</a> |
                            <a href="resena-eliminar.php?id=<?php echo $resena['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar esta reseña?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No hay reseñas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
    
    <script>
        // Script para el menú hamburguesa
        document.getElementById('navHamb').addEventListener('click', function() {
            var menu = document.getElementById('navMenu');
            menu.classList.toggle('show');
        });
        
        function filtrarPorCalificacion() {
            const calificacion = document.getElementById('rating-filter').value;
            if (calificacion === 'all') {
                window.location.href = 'resena.php';
            } else {
                window.location.href = `resena.php?u=reseña&f=FiltrarPorCalificacion&calificacion=${calificacion}`;
            }
        }
        
        function filtrarPorProducto() {
            const producto_id = document.getElementById('product-filter').value;
            if (producto_id === 'all') {
                window.location.href = 'resena.php';
            } else {
                window.location.href = `resena.php?u=reseña&f=FiltrarPorProducto&producto_id=${producto_id}`;
            }
        }
    </script>
    <script src="../../ASSETS/js/admin-resenas.js"></script>
</body>
</html>
<?php
require_once __DIR__ . '/../../CONTROLLER/ReseñaController.php';

$reseñaController = new ReseñaController();

$mensaje = "";
if (isset($_GET['mensaje'])) {
    if ($_GET['mensaje'] === 'eliminado') {
        $mensaje = "<p style='color: green;'>✅ Reseña eliminada correctamente.</p>";
    }
} elseif (isset($_GET['error'])) {
    if ($_GET['error'] === 'no_eliminado') {
        $mensaje = "<p style='color: red;'>❌ Error al eliminar la reseña.</p>";
    } elseif ($_GET['error'] === 'id_invalido') {
        $mensaje = "<p style='color: red;'>❌ ID de reseña inválido.</p>";
    }
}

if (isset($_GET['idReseña']) && !empty($_GET['idReseña'])) {
    $resenas = $reseñaController->buscarResena($_GET['idReseña']);
} else {
    $resenas = $reseñaController->listarResenas();
}

if (!is_array($resenas)) {
    $resenas = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reseñas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Gestión de Reseñas</h2>

     Agregado bloque para mostrar mensajes de feedback 
    <?php if (!empty($mensaje)): ?>
        <?php echo $mensaje; ?>
    <?php endif; ?>

    <form method="GET" action="">
        <input type="text" name="idReseña" placeholder="Buscar por ID">
        <button type="submit">Buscar</button>
    </form>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Calificacion</th>
                <th>Observacion</th>
                <th>Producto FK</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($resenas)) : ?>
                <?php foreach ($resenas as $resena) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($resena['idReseña']); ?></td>
                        <td><?php echo htmlspecialchars($resena['CalificacionProducto']); ?></td>
                        <td><?php echo htmlspecialchars($resena['ObservacionProducto']); ?></td>
                        <td><?php echo htmlspecialchars($resena['CodProductoFK']); ?></td>
                        <td>
                            <a href="resena-eliminar.php?idReseña=<?php echo $resena['idReseña']; ?>" onclick="return confirm('¿Seguro que deseas eliminar esta reseña?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No hay reseñas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
