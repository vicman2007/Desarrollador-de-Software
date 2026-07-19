<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Administrador - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <?php
        require_once '../CONTROLLER/PerfilController.php';

        $controlador = new PerfilController();

        $idUsuario = 1;
        
        $alm = $controlador->mostrarPerfil($idUsuario);
?>
</body>
</html>