<?php
require_once 'database.php';

class DomicilioModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function obtenerTodos() {
        $sql = "SELECT p.idCarrito, p.nombreUsuario, p.productosAñadidos, p.Estado, 
                p.DireccionEntrega, p.FechaYHoraEntrega, p.FormaPago
                FROM Pedidos p 
                WHERE p.Estado IN ('listo', 'en_curso', 'entregado', 'realizado')
                ORDER BY p.FechaYHoraEntrega DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtenerPorEstado($estado) {
        if ($estado == 'all') {
            return $this->obtenerTodos();
        }
        
        $sql = "SELECT p.idCarrito, p.nombreUsuario, p.productosAñadidos, p.Estado, 
                p.DireccionEntrega, p.FechaYHoraEntrega, p.FormaPago
                FROM Pedidos p 
                WHERE p.Estado = ?
                ORDER BY p.FechaYHoraEntrega DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function actualizarEstado($id, $estado) {
        $sql = "UPDATE Pedidos SET Estado = ? WHERE idCarrito = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $estado, $id);
        return $stmt->execute();
    }
    
    public function obtenerResumenDia() {
        $sql = "SELECT 
                COUNT(*) as total_domicilios,
                SUM(CASE WHEN Estado = 'en_curso' THEN 1 ELSE 0 END) as en_curso,
                SUM(CASE WHEN Estado = 'entregado' THEN 1 ELSE 0 END) as entregados
                FROM Pedidos 
                WHERE DATE(FechaYHoraEntrega) = CURDATE()";
        
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
}
?>
