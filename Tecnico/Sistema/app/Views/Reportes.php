<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .reportes-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-bottom: 20px;
        }
        
        .reportes-header {
            text-align: center;
            margin-bottom: 30px;
            color: #f70c5b;
        }
        
        .reportes-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 24px;
            color: #495057;
            margin-bottom: 20px;
            border-bottom: 2px solid #f70c5b;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            color: #f70c5b;
        }
        
        .reportes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .reporte-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .reporte-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            border-color: #f70c5b;
        }
        
        .reporte-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
        
        .reporte-title {
            font-size: 18px;
            font-weight: bold;
            color: #495057;
            margin-bottom: 10px;
        }
        
        .reporte-description {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.4;
        }
        
        .btn-reporte {
            background: linear-gradient(135deg, #f70c5b 0%, #e91e63 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            width: 100%;
        }
        
        .btn-reporte:hover {
            background: linear-gradient(135deg, #c02a5b 0%, #d81b60 100%);
            transform: scale(1.05);
            color: white;
            text-decoration: none;
        }
        
        .btn-reporte i {
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            .reportes-grid {
                grid-template-columns: 1fr;
            }
            
            .reportes-container {
                margin: 10px;
                padding: 15px;
            }
        }
    </style>
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
                <a href="../VIEW/usuario.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../VIEW/producto/producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../VIEW/pedido/pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../VIEW/reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../VIEW/domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../VIEW/estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas Diarias</a>
                <a href="../VIEW/mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Productos Más Vendidos</a>
                <a href="../VIEW/perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../VIEW/Reportes.php" class="active"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../indexHome.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>

        <!-- Contenido Principal de Reportes -->
        <div class="reportes-container">
            <div class="reportes-header">
                <h1><i class="fas fa-file-alt"></i> Centro de Reportes</h1>
                <p>Genera y descarga reportes detallados de tu repostería</p>
            </div>

            <!-- Reportes Generales -->
            <div class="reportes-section">
                <h2 class="section-title">
                    <i class="fas fa-chart-bar"></i>
                    Reportes Generales
                </h2>
                
                <div class="reportes-grid">
                    <div class="reporte-card">
                        <div class="reporte-title">Reporte de Pedidos</div>
                        <a href="Reporte_Ped.php" class="btn-reporte">
                            <i class="fas fa-download"></i>Generar Reporte
                        </a>
                    </div>

                    <div class="reporte-card">
                        <div class="reporte-title">Reporte de Productos</div>
                        <a href="Reporte_Pro.php" class="btn-reporte">
                            <i class="fas fa-download"></i>Generar Reporte
                        </a>
                    </div>

                    <div class="reporte-card">
                        <div class="reporte-title">Reporte de Clientes</div>
                        <a href="Reporte_Usu.php" class="btn-reporte">
                            <i class="fas fa-download"></i>Generar Reporte
                        </a>
                    </div>

                    <div class="reporte-card">
                        <div class="reporte-title">Reporte de Reseñas</div>
                        <a href="../VIEW/Reporte_Res.php" class="btn-reporte">
                            <i class="fas fa-download"></i>Generar Reporte
                        </a>
                    </div>

                </div>
            </div>

            <!-- Reportes Multitablas -->
            <div class="reportes-section">
                <h2 class="section-title">
                    <i class="fas fa-table"></i>
                    Reportes Multitablas
                </h2>
                
                <div class="reportes-grid">
                    <div class="reporte-card">
                        <div class="reporte-title">Reseña por Producto</div>
                        <a href="../VIEW/Reporte_Res_Ped.php" class="btn-reporte">
                            <i class="fas fa-download"></i>Generar Reporte
                        </a>
                    </div>

                    <div class="reporte-card">
                        <div class="reporte-title">Reseña por Usuario</div>
                        <a href="../VIEW/Report_Res_Usu.php" class="btn-reporte">
                            <i class="fas fa-download"></i>Generar Reporte
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2024 | Bogotá</p>
        </footer>
    </div>
</body>
</html>