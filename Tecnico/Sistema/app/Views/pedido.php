<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
            
<?php
require_once '../MODEL/database.php';

$controller = 'Pedido';

require_once "../controller/$controller.controller.php";	

if (!isset($_REQUEST['e'])) {
    $controllerClass = 'Pedidocontroller';
    $controllerInstance = new $controllerClass;
    $controllerInstance->Index();
} else {
    $controller = strtolower($_REQUEST['e']);
    $accion = isset($_REQUEST['f']) ? $_REQUEST['f'] : 'Index';
    
    $controllerClass = 'Pedidocontroller';
    $controllerInstance = new $controllerClass;

    call_user_func(array($controllerInstance, $accion));
}
?>

</body>
</html>
