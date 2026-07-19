<?php
require_once '../MODEL/EstadisticaModel.php';

class EstadisticaController {
    private $model;
    
    public function __construct() {
        $this->model = new EstadisticaModel();
    }
    
    public function Index() {
        $estadisticasDiarias = $this->model->obtenerEstadisticasDiarias();
        $resumenGeneral = $this->model->obtenerResumenGeneral();
        $tendencias = $this->model->obtenerTendencias();
        $mensaje = '';
        
        include '../VIEW/admin-estadisticas.php';
    }
    
    public function ObtenerPorPeriodo() {
        $dias = isset($_GET['dias']) ? $_GET['dias'] : 30;
        $estadisticasDiarias = $this->model->obtenerEstadisticasDiarias($dias);
        $resumenGeneral = $this->model->obtenerResumenGeneral();
        $tendencias = $this->model->obtenerTendencias();
        $mensaje = '';
        
        include '../VIEW/admin-estadisticas.php';
    }
}
?>
