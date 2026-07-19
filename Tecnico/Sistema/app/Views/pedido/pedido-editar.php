<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestión de Pedidos - Repostería Misves</title>
<link rel="icon" type="image/x-icon" href="../../ASSETS/img/icon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<style>
    :root {
        --color-primary: #f70c5b;
        --color-secondary: #ffb6c1;
        --color-complementary: #ffe6d5;
        --color-background: #f3c5c5;
        --color-text: #333;
        --color-white: #ffffff;
        --color-success: #28a745;
        --color-danger: #dc3545;
        --shadow-light: 0 2px 10px rgba(0,0,0,0.1);
        --shadow-medium: 0 5px 15px rgba(0,0,0,0.15);
        --shadow-heavy: 0 10px 25px rgba(0,0,0,0.2);
        --font-main: "Arial", sans-serif;
    }
    *{box-sizing:border-box;margin:0;padding:0;}
    body{background:linear-gradient(135deg, rgba(243,197,197,0.9), rgba(255,230,213,0.8)), url('/ASSETS/img/bg.jpg') center/cover;font-family:var(--font-main);color:var(--color-text);line-height:1.6;min-height:100vh;}
    .container-full{min-height:100vh;background-color: rgba(243,197,197,0.95);padding:20px;}
    .logo{width:200px;transition: transform 0.3s ease; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));}
    .logo:hover{transform:scale(1.05);}
    nav{background: linear-gradient(135deg, var(--color-primary), #e60a50); padding:15px; margin-bottom:30px; border-radius:15px; box-shadow:var(--shadow-medium);}
    #navMenu{display:flex; justify-content:center; gap:20px; flex-wrap:wrap;}
    nav a{color:var(--color-white); text-decoration:none; padding:12px 18px; border-radius:8px; transition: all 0.3s ease; display:flex; align-items:center; gap:8px; font-weight:500;}
    nav a:hover{background-color: var(--color-white); color:var(--color-primary); transform: translateY(-2px); box-shadow: var(--shadow-light);}
    .page-header{text-align:center; color:#e60a50;}
    .form-container{max-width:800px; margin:0 auto; background: var(--color-white); border-radius:20px; padding:40px; box-shadow: var(--shadow-heavy); position:relative; overflow:hidden; animation: slideInUp 0.6s ease-out;}
    .form-container::before{content:''; position:absolute; top:0; left:0; right:0; height:5px; background: linear-gradient(90deg, var(--color-primary), var(--color-secondary), var(--color-complementary));}
    .formU{display:grid; gap:25px;}
    .form-group{position:relative; animation: slideInUp 0.6s ease-out; animation-fill-mode:both;}
    .form-group label{display:block; font-weight:600; margin-bottom:8px; color:var(--color-primary); font-size:1.1rem; display:flex; align-items:center; gap:8px;}
    .form-group label::before{content:''; width:4px; height:20px; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); border-radius:2px;}
    .form-control{width:100%; padding:15px 20px; border:2px solid #e1e5e9; border-radius:12px; font-size:16px; transition:all 0.3s ease; background-color:#fafbfc; position:relative;}
    .form-control:focus{outline:none; border-color: var(--color-primary); background-color: var(--color-white); box-shadow:0 0 0 3px rgba(247,12,91,0.1); transform:translateY(-2px);}
    .form-control:hover{border-color: var(--color-secondary); background-color: var(--color-white);}
    select.form-control{cursor:pointer; appearance:none; padding-right:45px; background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e"); background-position:right 12px center; background-repeat:no-repeat; background-size:16px;}
    select.form-control:focus{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23f70c5b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");}
    .form-row{display:grid; grid-template-columns:1fr 1fr; gap:25px;}
    .btn-container{display:flex; gap:15px; justify-content:center; margin-top:30px; padding-top:30px; border-top:2px solid #f1f3f4;}
    .btn{padding:15px 30px; border:none; border-radius:12px; font-size:16px; font-weight:600; cursor:pointer; transition:all 0.3s ease; display:flex; align-items:center; gap:10px; text-decoration:none; min-width:140px; justify-content:center;}
    .btn-success{background: linear-gradient(135deg, var(--color-success), #20a83a); color:var(--color-white); box-shadow: var(--shadow-light);}
    .btn-success:hover{background: linear-gradient(135deg, #20a83a, var(--color-success)); transform:translateY(-3px); box-shadow: var(--shadow-medium);}
    .btn-secondary{background: linear-gradient(135deg, #6c757d, #5a6268); color:var(--color-white); box-shadow: var(--shadow-light);}
    .btn-secondary:hover{background: linear-gradient(135deg, #5a6268, #6c757d); transform:translateY(-3px); box-shadow: var(--shadow-medium);}
    @keyframes slideInUp{from{opacity:0; transform:translateY(30px);} to{opacity:1; transform:translateY(0);}}
    @media(max-width:768px){.form-row{grid-template-columns:1fr; gap:20px;} .btn-container{flex-direction:column; align-items:center;} .btn{width:100%; max-width:300px;}}
    .footer{background: linear-gradient(135deg, var(--color-primary), #e60a50); color: var(--color-white); padding:20px; text-align:center; margin-top:40px; border-radius:15px; box-shadow: var(--shadow-medium);}
</style>
</head>
<body>
<div class="container-full">
    <header class="text-center">
        <img src="../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
    </header>

    <nav>
        <div id="navMenu">
            <a href="../usuario.php"><i class="fas fa-users"></i>Usuario</a>
            <a href="../producto.php"><i class="fas fa-birthday-cake"></i>Productos</a>
            <a href="/VIEW/pedido.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
            <a href="../reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
            <a href="../domicilio/admin-domicilios.php"><i class="fas fa-truck"></i>Domicilios</a>
            <a href="../estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas</a>
            <a href="../mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Más Vendidos</a>
            <a href="../perfil/admin-perfil.php"><i class="fas fa-user"></i>Perfil</a>
            <a href="../Reportes.php"><i class="fas fa-file-alt"></i>Reportes</a>
            <a href="../../indexHome.php"><i class="fas fa-home"></i>Salir</a>
        </div>
    </nav>

    <h2 class="page-header">
        <?php echo $alm->idCarrito != null ? 'Editar Pedido: ' . htmlspecialchars($alm->nombreUsuario) : 'Nuevo Pedido'; ?>
    </h2>

    <div class="form-container">
        <!-- Corregida la acción del formulario para usar la ruta correcta -->
        <form action="../pedido.php?e=pedido&f=Guardar" method="post" enctype="multipart/form-data" class="formU">
            <input type="hidden" name="idCarrito" value="<?php echo $alm->idCarrito; ?>">

            <div class="form-group">
                <label><i class="fas fa-user"></i> Usuario</label>
                <input type="text" name="nombreUsuario" value="<?php echo htmlspecialchars($alm->nombreUsuario); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-birthday-cake"></i> Productos</label>
                <input type="text" name="productosAñadidos" value="<?php echo htmlspecialchars($alm->productosAñadidos); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-toggle-on"></i> Estado</label>
                <select name="Estado" class="form-control" required>
                    <option value="Pendiente" <?php echo $alm->Estado=='Pendiente'?'selected':''; ?>>Pendiente</option>
                    <option value="Enviado" <?php echo $alm->Estado=='Enviado'?'selected':''; ?>>Enviado</option>
                    <option value="Entregado" <?php echo $alm->Estado=='Entregado'?'selected':''; ?>>Entregado</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-map-marker-alt"></i> Dirección</label>
                <input type="text" name="DireccionEntrega" value="<?php echo htmlspecialchars($alm->DireccionEntrega); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-calendar-alt"></i> Fecha y Hora</label>
                <input type="datetime-local" name="FechaYHoraEntrega" value="<?php echo $alm->FechaYHoraEntrega ? date('Y-m-d\TH:i', strtotime($alm->FechaYHoraEntrega)) : ''; ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-credit-card"></i> Forma de Pago</label>
                <input type="text" name="FormaPago" value="<?php echo htmlspecialchars($alm->FormaPago); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-id-badge"></i> ID Usuario (FK)</label>
                <input type="number" name="idUsuarioFK" value="<?php echo $alm->idUsuarioFK; ?>" class="form-control" required>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <!-- Corregida la ruta de cancelar -->
                <a href="../pedido.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>

    <footer class="footer">
        <p><i class="fas fa-heart"></i> Derechos reservados Repostería Misves | 2024 | Bogotá</p>
    </footer>
</div>
</body>
</html>
