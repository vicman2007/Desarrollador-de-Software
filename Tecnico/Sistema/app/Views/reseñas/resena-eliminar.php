<?php
require_once __DIR__ . '/../../CONTROLLER/ReseñaController.php';

$reseñaController = new ReseñaController();

if (isset($_GET['idReseña']) && !empty($_GET['idReseña'])) {
    $idReseña = intval($_GET['idReseña']);
    
    if ($reseñaController->eliminarResena($idReseña)) {
        header("Location: admin-resenas.php?mensaje=eliminado");
        exit();
    } else {
        header("Location: admin-resenas.php?error=no_eliminado");
        exit();
    }
} else {
    header("Location: admin-resenas.php?error=id_invalido");
    exit();
}
?>
