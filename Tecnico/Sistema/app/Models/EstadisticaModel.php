<?php
require_once 'database.php';

class EstadisticaModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function obtenerEstadisticasDiarias($dias = 30) {
        $sql = "SELECT 
                DATE(FechaYHoraEntrega) as fecha,
                COUNT(*) as total_domicilios,
                SUM(TotalComprar) as ingresos,
                AVG(TotalComprar) as promedio_pedido
                FROM Pedidos 
                WHERE FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
                AND Estado = 'entregado'
                GROUP BY DATE(FechaYHoraEntrega)
                ORDER BY fecha DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $dias);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtenerResumenGeneral() {
        $sql = "SELECT 
                (SELECT COUNT(*) FROM Pedidos WHERE DATE(FechaYHoraEntrega) = CURDATE()) as domicilios_hoy,
                (SELECT COUNT(*) FROM Pedidos WHERE FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)) as domicilios_semana,
                (SELECT COUNT(*) FROM Pedidos WHERE FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) as domicilios_mes,
                (SELECT SUM(TotalComprar) FROM Pedidos WHERE DATE(FechaYHoraEntrega) = CURDATE() AND Estado = 'entregado') as ingresos_hoy";
        
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    public function obtenerTendencias() {
        $sql = "SELECT 
                DAYNAME(FechaYHoraEntrega) as dia_semana,
                COUNT(*) as total_pedidos,
                AVG(TotalComprar) as promedio_venta
                FROM Pedidos 
                WHERE FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 4 WEEK)
                GROUP BY DAYOFWEEK(FechaYHoraEntrega), DAYNAME(FechaYHoraEntrega)
                ORDER BY DAYOFWEEK(FechaYHoraEntrega)";
        
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
