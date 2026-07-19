<?php
require_once '../MODEL/MasVendidosModel.php';

class MasVendidosController {
    private $model;
    
    public function __construct() {
        $this->model = new MasVendidosModel();
    }
    
    public function Index() {
        $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'month';
        $masVendidos = $this->model->obtenerMasVendidos($periodo);
        $estadisticas = $this->model->obtenerEstadisticasVentas($periodo);
        $ranking = $this->model->obtenerRankingDetallado($periodo);
        $mensaje = '';
        
        include '../VIEW/admin-mas-vendidos.php';
    }
    
    public function ObtenerPorPeriodo() {
        $periodo = $_GET['periodo'];
        $masVendidos = $this->model->obtenerMasVendidos($periodo);
        $estadisticas = $this->model->obtenerEstadisticasVentas($periodo);
        $ranking = $this->model->obtenerRankingDetallado($periodo);
        $mensaje = '';
        
        include '../VIEW/admin-mas-vendidos.php';
    }
    
    public function VerAnalisisDetallado() {
        $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'month';
        $resumenEjecutivo = $this->model->obtenerResumenEjecutivo($periodo);
        $mejorRendimiento = $this->model->obtenerMejorRendimiento($periodo);
        $productosEnDeclive = $this->model->obtenerProductosEnDeclive();
        $analisisPrecios = $this->model->obtenerAnalisisPrecios();
        $mensaje = '';
        
        include '../VIEW/admin-mas-vendidos-detalle.php';
    }
    
    public function CompararProducto() {
        $productoId = $_GET['id'];
        $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'month';
        
        $comparativa = $this->model->obtenerComparativaPeriodos($productoId, $periodo, $periodo);
        $mensaje = '';
        
        // Retornar JSON para AJAX o incluir vista específica
        header('Content-Type: application/json');
        echo json_encode($comparativa);
    }
    
    public function ExportarReporte() {
        $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'month';
        $resumen = $this->model->obtenerResumenEjecutivo($periodo);
        
        // Generar CSV o PDF según necesidad
        $this->generarReporteCSV($resumen, $periodo);
    }
    
    private function generarReporteCSV($datos, $periodo) {
        $filename = "mas_vendidos_" . $periodo . "_" . date('Y-m-d') . ".csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Encabezados
        fputcsv($output, ['Posicion', 'Producto', 'Unidades Vendidas', 'Ingresos Totales', 'Precio Unitario']);
        
        // Datos
        foreach($datos['top_3_vendidos'] as $index => $producto) {
            fputcsv($output, [
                $index + 1,
                $producto['NombreProducto'],
                $producto['total_vendidos'],
                $producto['ingresos_totales'],
                $producto['Precio']
            ]);
        }
        
        fclose($output);
    }
}
?>
