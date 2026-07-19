<?php
require_once __DIR__ . '/../../CONTROLLER/ReseñaController.php';

$controller = new ReseñaController();
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CalificacionProducto = $_POST['CalificacionProducto'];
    $ObservacionProducto = $_POST['ObservacionProducto'];
    $CodProductoFK = $_POST['CodProductoFK'];

    if ($controller->crearResena($CalificacionProducto, $ObservacionProducto, $CodProductoFK) {
        $mensaje = "✅ Reseña registrada correctamente.";
    } else {
        $mensaje = "❌ Error al registrar la reseña.";
    }
}
?>

