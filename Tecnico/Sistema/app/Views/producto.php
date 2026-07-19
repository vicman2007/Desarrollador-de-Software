<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
            
<?php
require_once '../MODEL/database.php';


$controller = 'Producto';

require_once "../CONTROLLER/$controller.controller.php";	


if (!isset($_REQUEST['p'])) {
    $controller = ucfirst($controller).'Controller';
    $controller = new $controller;
    $controller->Index();
} else {
    
    $controller = strtolower($_REQUEST['p']);
    $accion = isset($_REQUEST['f']) ? $_REQUEST['f'] : 'Index';
f
    $controller = ucfirst($controller).'Controller';
    $controller = new $controller;

   
    call_user_func(array($controller, $accion));
}
?>

</body>
</html>
