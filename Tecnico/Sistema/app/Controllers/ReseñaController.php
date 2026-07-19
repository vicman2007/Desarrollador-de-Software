<?php
require_once __DIR__ . '/../MODEL/ReseñaModel.php';

class ReseñaController {
    private $model;

    public function __construct() {
        $this->model = new ReseñaModel();
    }

    public function listarResenas() {
        $resenas = $this->model->obtenerResenas();
        return is_array($resenas) ? $resenas : [];
    }

    public function buscarResena($idReseña) {
        if (empty($idReseña)) return [];
        $resena = $this->model->obtenerResenaPorId($idReseña);
        return $resena ? [$resena] : [];
    }

    public function crearResena($CalificacionProducto, $ObservacionProducto, $CodProductoFK) {
        return $this->model->insertarResena($CalificacionProducto, $ObservacionProducto, $CodProductoFK);
    }

    public function actualizarResena($idReseña, $CalificacionProducto, $ObservacionProducto, $CodProductoFK) {
        return $this->model->editarResena($idReseña, $CalificacionProducto, $ObservacionProducto, $CodProductoFK);
    }

    public function eliminarResena($idReseña) {
        return $this->model->borrarResena($idReseña);
    }
}
?>
