<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Repostería Misves</title>
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
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
            --color-warning: #ffc107;
            --color-info: #17a2b8;
            --font-main: "Arial", sans-serif;
            --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 5px 15px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, rgba(243, 197, 197, 0.9), rgba(255, 230, 213, 0.8)),
                        url('/ASSETS/img/bg.jpg') center/cover;
            font-family: var(--font-main);
            color: var(--color-text);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container-full {
            min-height: 100vh;
            background-color: rgba(243, 197, 197, 0.95);
            padding: 20px;
        }

        .logo {
            width: 200px;
            transition: transform 0.3s ease;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .logo:hover {
            transform: scale(1.05);
        }

        /* Navigation */
        nav {
            background: linear-gradient(135deg, var(--color-primary), #e60a50);
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow-medium);
        }

        #navHamb {
            display: none;
            color: var(--color-white);
            font-size: 24px;
            cursor: pointer;
        }

        #navMenu {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav a {
            color: var(--color-white);
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        nav a:hover {
            background-color: var(--color-white);
            color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-light);
        }

        /* Header del formulario */
        .page-header {
            color: #e60a50;
            text-align: center;
        }

        /* Contenedor del formulario */
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
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary), var(--color-complementary));
        }

        .formU {
            display: grid;
            gap: 25px;
        }

        /* Grupos de formulario */
        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--color-primary);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label::before {
            content: '';
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 2px;
        }

        /* Estilos de inputs */
        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #fafbfc;
            position: relative;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            background-color: var(--color-white);
            box-shadow: 0 0 0 3px rgba(247, 12, 91, 0.1);
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: var(--color-secondary);
            background-color: var(--color-white);
        }

        /* Estilos específicos para select */
        select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 45px;
            appearance: none;
        }

        select.form-control:focus {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23f70c5b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        }

        /* Grid para organizar campos */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-row-three {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 25px;
        }

        /* Botones */
        .btn-container {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f1f3f4;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            min-width: 140px;
            justify-content: center;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--color-success), #20a83a);
            color: var(--color-white);
            box-shadow: var(--shadow-light);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #20a83a, var(--color-success));
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: var(--color-white);
            box-shadow: var(--shadow-light);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #6c757d);
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        /* Indicadores de validación */
        .form-control:valid {
            border-color: var(--color-success);
        }

        .form-control:invalid:not(:placeholder-shown) {
            border-color: var(--color-danger);
        }

        /* Tooltips para ayuda */
        .form-group::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -25px;
            left: 0;
            font-size: 12px;
            color: #6c757d;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-group:hover::after {
            opacity: 1;
        }

        /* Animaciones */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            animation: slideInUp 0.6s ease-out;
        }

        .form-group {
            animation: slideInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

        /* Responsive Design */
        @media (max-width: 768px) {
            #navHamb {
                display: block;
            }

            #navMenu {
                display: none;
                flex-direction: column;
            }

            #navMenu.active {
                display: flex;
            }

            .form-container {
                padding: 25px;
                margin: 10px;
            }

            .form-row,
            .form-row-three {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .btn-container {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .page-header {
                font-size: 1.8rem;
                padding: 20px;
            }
        }

        /* Estados de carga */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--color-primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--color-primary), #e60a50);
            color: var(--color-white);
            padding: 20px;
            text-align: center;
            margin-top: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow-medium);
        }

        /* Mejoras adicionales */
        .text-center {
            text-align: center;
        }

        .hidden {
            display: none;
        }

        /* Efectos de enfoque mejorados */
        .form-control:focus + .form-label {
            color: var(--color-primary);
            transform: translateY(-2px);
        }
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
            <div id="navHamb">
                <i class="fas fa-bars"></i>
            </div>
            <div id="navMenu">
                <a href="../VIEW/usuario.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../VIEW/producto/admin-producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../VIEW/pedido/admin-pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../VIEW/reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../VIEW/domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../VIEW/estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas</a>
                <a href="../VIEW/mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Más Vendidos</a>
                <a href="../VIEW/perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../VIEW/Reportes.php"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../indexHome.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        <h1 class="page-header">
            <i class="fas fa-user-edit"></i>
            <?php echo $alm->idUsuario != null ? 'Editar Usuario: ' . $alm->nombreUsuario : 'Nuevo Usuario'; ?>
        </h1>

        <div class="form-container">
            <form id="frm-usuario" action="?u=Usuario&f=Guardar" method="post" class="formU">
                <input type="hidden" name="idUsuario" value="<?php echo $alm->idUsuario; ?>" />
                
                <div class="form-group" >
                    <label>
                        <i class="fas fa-user"></i>
                        Nombre Completo
                    </label>
                    <input type="text" name="nomU" value="<?php echo $alm->nombreUsuario; ?>" class="form-control" placeholder="Ingrese el nombre completo del usuario" pattern="[A-Za-zñÑáÁéÉíÍóÓúÚ ]+" title="Ingrese un nombre válido (3 a 50 letras)" minlength="3" maxlength="50" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-id-card"></i>
                            Tipo de Documento
                        </label>
                        <input type="text" name="Tipodoc" value="<?php echo $alm->tipodocumento; ?>" class="form-control" placeholder="Ingrese CC para cédula TI tarjeta" pattern="[a-zA-Z]+"  title="Ingrese un Tipo de Documento válido (CC o TI)" minlength="2" maxlength="2" required>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-hashtag"></i>
                             Número de Documento
                            </label>
                        <input type="text" name="numdoc" value="<?php echo $alm->NoDoc; ?>" class="form-control" placeholder="Ej: 12345678" pattern="[0-9]+" title="Ingrese un número de documento válido (8 a 12 dígitos)" minlength="8" maxlength="12" required>
                    </div>
                </div>

                <div class="form-group" >
                    <label>
                        <i class="fas fa-envelope"></i>
                        Correo Electrónico
                    </label>
                    <input type="email" name="correoUsuario" value="<?php echo $alm->correoUsuario; ?>" class="form-control" placeholder="ejemplo@correo.com" minlength="5" maxlength="50" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label> 
                            <i class="fas fa-map-marker-alt"></i>
                            Dirección
                        </label>
                        <input type="text" name="direccion" value="<?php echo $alm->direccionUsuario; ?>" class="form-control" placeholder="Calle 123 #45-67" title="Ingrese una dirección válida" minlength="8" required>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-phone"></i>
                            Teléfono
                        </label>
                        <input type="text" name="TelUsuario" value="<?php echo $alm->telefonoUsuario; ?>" class="form-control" placeholder="3001234567" pattern="[0-9]+" title="Ingrese un número de teléfono válido"  maxlength="10" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-toggle-on"></i>
                            Estado del Usuario
                        </label>
                        <select name="estadoUsuario" class="form-control" required>
                            <option value="Activo" <?php echo $alm->estadoUsuario == "Activo" ? 'selected' : ''; ?>><i class="fas fa-check-circle"></i> Activo</option>
                            <option value="Inactivo" <?php echo $alm->estadoUsuario == "Inactivo" ? 'selected' : ''; ?>><i class="fas fa-times-circle"></i> Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-user-tag"></i>Tipo de Usuario</label>
                        <select name="idRol" class="form-control" required>
                            <option value="">Seleccione rol</option>
                            <option value="1" <?php echo $alm->idRolFK == 1 ? 'selected' : ''; ?>>Cliente</option>
                            <option value="2" <?php echo $alm->idRolFK == 2 ? 'selected' : ''; ?>>Administrador</option>
                            <option value="3" <?php echo $alm->idRolFK == 3 ? 'selected' : ''; ?>>Domiciliario</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock"></i>Contraseña</label>
                    <input type="password" name="contraUsuario" value="<?php echo $alm->contraseña; ?>" class="form-control" placeholder="Ingrese una contraseña segura" pattern="[A-Za-z0-9#$%&-]{8,20}" title="La contraseña debe tener entre 8 y 20 caracteres" minlength="8" maxlength="20" required>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Guardar Usuario
                    </button>
                    <a href="../VIEW/usuario.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Volver
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