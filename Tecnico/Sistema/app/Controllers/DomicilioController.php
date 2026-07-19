<?php
require_once '../MODEL/database.php';
require_once '../MODEL/DomicilioModel.php';

class DomicilioController {
    private $model;
    
    public function __construct() {
        $this->model = new DomicilioModel();
    }
    
    public function Index() {
        $domicilios = $this->model->obtenerTodos();
        $resumen = $this->model->obtenerResumenDia();
        $mensaje = '';
        
        require '../VIEW/domicilio/admin-domicilios.php';
    }
    
    public function ActualizarEstado() {
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        
        $resultado = $this->model->actualizarEstado($id, $estado);
        $mensaje = $resultado ? 'Estado actualizado correctamente' : 'Error al actualizar estado';
        
        $domicilios = $this->model->obtenerTodos();
        $resumen = $this->model->obtenerResumenDia();
        
        require '../VIEW/domicilio/admin-domicilios.php';
    }
    
    public function FiltrarPorEstado() {
        $estado = $_GET['estado'];
        $domicilios = $this->model->obtenerPorEstado($estado);
        $resumen = $this->model->obtenerResumenDia();
        $mensaje = '';
        
        require '../VIEW/domicilio/admin-domicilios.php';
    }
}
?>
