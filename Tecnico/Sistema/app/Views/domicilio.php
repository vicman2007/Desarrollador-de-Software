<?php
require_once '../MODEL/database.php';

$controller = 'Domicilio';
require_once "../CONTROLLER/{$controller}Controller.php";

if(!isset($_REQUEST['u'])) {
    $controllerClass = $controller.'Controller';
    $controllerInstance = new $controllerClass;
    $controllerInstance->Index();
} else {
    $controller = strtolower($_REQUEST['u']);
    $accion = isset($_REQUEST['f']) ? $_REQUEST['f'] : 'Index';
    
    require_once "../CONTROLLER/" . ucfirst($controller) . "Controller.php";
    $controllerClass = ucfirst($controller).'Controller';
    $controllerInstance = new $controllerClass;
    
    call_user_func(array($controllerInstance, $accion));
}
?>
