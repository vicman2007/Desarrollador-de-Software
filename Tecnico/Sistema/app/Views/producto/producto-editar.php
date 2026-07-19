<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Repostería Misves</title>
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* --- mismos estilos del formulario de usuario --- */
        :root {
            --color-primary: #f70c5b;
            --color-secondary: #ffb6c1;
            --color-complementary: #ffe6d5;
            --color-background: #f3c5c5;
            --color-text: #333;
            --color-white: #ffffff;
            --color-success: #28a745;
            --color-danger: #dc3545;
            --font-main: "Arial", sans-serif;
            --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 5px 15px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: linear-gradient(135deg, rgba(243, 197, 197, 0.9), rgba(255, 230, 213, 0.8)),
                        url('/ASSETS/img/bg.jpg') center/cover;
            font-family: var(--font-main);
            color: var(--color-text);
            line-height: 1.6;
            min-height: 100vh;
        }
        .container-full { min-height: 100vh; background-color: rgba(243, 197, 197, 0.95); padding: 20px; }
        .logo { width: 200px; transition: transform 0.3s ease; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1)); }
        .logo:hover { transform: scale(1.05); }

        nav { background: linear-gradient(135deg, var(--color-primary), #e60a50); padding: 15px; margin-bottom: 30px; border-radius: 15px; box-shadow: var(--shadow-medium); }
        #navMenu { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
        nav a { color: var(--color-white); text-decoration: none; padding: 12px 18px; border-radius: 8px; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; font-weight: 500; }
        nav a:hover { background-color: var(--color-white); color: var(--color-primary); transform: translateY(-2px); box-shadow: var(--shadow-light); }

        .page-header { color: #e60a50; text-align: center; margin-bottom: 25px; }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--color-white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-heavy);
            position: relative;
            overflow: hidden;
        }
        .form-container::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary), var(--color-complementary));
        }

        .formU { display: grid; gap: 25px; }
        .form-group label {
            display: block; font-weight: 600; margin-bottom: 8px;
            color: var(--color-primary); font-size: 1.1rem;
        }
        .form-control {
            width: 100%; padding: 15px 20px; border: 2px solid #e1e5e9; border-radius: 12px;
            font-size: 16px; transition: all 0.3s ease; background-color: #fafbfc;
        }
        .form-control:focus {
            outline: none; border-color: var(--color-primary);
            background-color: var(--color-white);
            box-shadow: 0 0 0 3px rgba(247, 12, 91, 0.1);
        }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .btn-container {
            display: flex; gap: 15px; justify-content: center;
            margin-top: 30px; padding-top: 30px; border-top: 2px solid #f1f3f4;
        }
        .btn {
            padding: 15px 30px; border: none; border-radius: 12px;
            font-size: 16px; font-weight: 600; cursor: pointer;
            transition: all 0.3s ease; display: flex; align-items: center;
            gap: 10px; text-decoration: none; min-width: 140px; justify-content: center;
        }
        .btn-success { background: linear-gradient(135deg, var(--color-success), #20a83a); color: var(--color-white); }
        .btn-success:hover { background: linear-gradient(135deg, #20a83a, var(--color-success)); transform: translateY(-3px); }
        .btn-secondary { background: linear-gradient(135deg, #6c757d, #5a6268); color: var(--color-white); }
        .btn-secondary:hover { background: linear-gradient(135deg, #5a6268, #6c757d); transform: translateY(-3px); }
        .footer { background: linear-gradient(135deg, var(--color-primary), #e60a50); color: var(--color-white); padding: 20px; text-align: center; margin-top: 40px; border-radius: 15px; box-shadow: var(--shadow-medium); }
    </style>
</head>

<body> 
    <div class="container-full">
        <header class="text-center">
            <a>
                <img src="../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
            </a>
        </header>

        <nav>
            <div id="navMenu">
                <a href="../VIEW/usuario.php"><i class="fas fa-users"></i>Usuarios</a>
                <a href="../VIEW/producto/admin-producto.php"><i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../VIEW/pedido/admin-pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../VIEW/reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../VIEW/domicilio/admin-domicilios.php"><i class="fas fa-truck"></i>Domicilios</a>
                <a href="../VIEW/estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas</a>
                <a href="../indexHome.php"><i class="fas fa-home"></i>Salir</a>
            </div>
        </nav>

        <h1 class="page-header">
            <i class="fas fa-birthday-cake"></i>
            <?php echo $alm->CodProducto != null ? 'Editar Producto: ' . $alm->NombreProducto : 'Nuevo Producto'; ?>
        </h1>

        <div class="form-container">
            <form id="frm-producto" action="?p=Producto&f=Guardar" method="post" enctype="multipart/form-data" class="formU">
                <input type="hidden" name="CodProducto" value="<?php echo $alm->CodProducto; ?>" />

                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Nombre del Producto</label>
                    <input type="text" name="NombreProducto" value="<?php echo $alm->NombreProducto; ?>" class="form-control" placeholder="Ej: Cupcake de Vainilla" minlength="3" maxlength="30" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-align-left"></i> Descripción</label>
                    <input type="text" name="DescripcionProducto" value="<?php echo $alm->DescripcionProducto; ?>" class="form-control" placeholder="Ej: Cupcake decorado con crema y chispas" maxlength="50" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-dollar-sign"></i> Precio</label>
                        <input type="number" step="0.01" name="Precio" value="<?php echo $alm->Precio; ?>" class="form-control" placeholder="Ej: 5000" min="0" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-boxes"></i> Stock</label>
                        <input type="number" name="stock" value="<?php echo $alm->stock; ?>" class="form-control" placeholder="Ej: 20" min="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-toggle-on"></i> Estado del Producto</label>
                    <select name="EstadoProducto" class="form-control" required>
                        <option value="Disponible" <?php echo $alm->EstadoProducto == "Disponible" ? 'selected' : ''; ?>>Disponible</option>
                        <option value="Agotado" <?php echo $alm->EstadoProducto == "Agotado" ? 'selected' : ''; ?>>Agotado</option>
                        <option value="Descontinuado" <?php echo $alm->EstadoProducto == "Descontinuado" ? 'selected' : ''; ?>>Descontinuado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-image"></i> Imagen del Producto</label>
                    <input type="file" name="ImagenProducto" class="form-control" accept="image/*" <?php echo $alm->CodProducto == null ? 'required' : ''; ?>>
                    <?php if (!empty($alm->ImagenProducto)): ?>
                        <p class="text-center"><img src="data:image/jpeg;base64,<?php echo base64_encode($alm->ImagenProducto); ?>" width="120" alt="Imagen actual"></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-star"></i> Reseña Asociada (ID)</label>
                    <input type="number" name="idReseñaFK" value="<?php echo $alm->idReseñaFK; ?>" class="form-control" placeholder="Ej: 1" min="1">
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Producto
                    </button>
                    <a href="../VIEW/producto/admin-producto.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>

        <footer class="footer">
            <p><i class="fas fa-heart"></i> Derechos reservados Repostería Misves | 2025 | Bogotá</p>
        </footer>
    </div>
</body>
</html>
