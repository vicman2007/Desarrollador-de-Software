<?php
require_once 'database.php';

class MasVendidosModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    /**
     * Obtener productos más vendidos por período
     */
    public function obtenerMasVendidos($periodo = 'month', $limite = 10) {
        $fechaCondicion = $this->obtenerCondicionFecha($periodo);
        
        $sql = "SELECT 
                    pr.CodProducto, 
                    pr.NombreProducto, 
                    pr.Precio, 
                    pr.DescripcionProducto,
                    pr.ImagenProducto,
                    COUNT(dp.CodProductoFK) as total_vendidos, 
                    SUM(dp.TotalProducto) as ingresos_totales,
                    SUM(dp.Cantidad) as unidades_vendidas,
                    AVG(dp.PrecioUnitario) as precio_promedio,
                    MAX(p.FechaYHoraEntrega) as ultima_venta
                FROM Producto pr 
                LEFT JOIN DetallePedido dp ON pr.CodProducto = dp.CodProductoFK
                LEFT JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito
                WHERE p.Estado = 'entregado' $fechaCondicion
                GROUP BY pr.CodProducto, pr.NombreProducto, pr.Precio, pr.DescripcionProducto, pr.ImagenProducto
                HAVING total_vendidos > 0
                ORDER BY total_vendidos DESC, ingresos_totales DESC 
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Obtener estadísticas generales de ventas
     */
    public function obtenerEstadisticasVentas($periodo = 'month') {
        $fechaCondicion = $this->obtenerCondicionFecha($periodo);
        
        $sql = "SELECT 
                    COUNT(DISTINCT pr.CodProducto) as productos_vendidos,
                    COUNT(dp.idDetalle) as total_transacciones,
                    SUM(dp.TotalProducto) as ingresos_totales,
                    SUM(dp.Cantidad) as unidades_totales,
                    AVG(dp.TotalProducto) as ticket_promedio,
                    MAX(dp.TotalProducto) as venta_maxima,
                    MIN(dp.TotalProducto) as venta_minima
                FROM DetallePedido dp
                JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito
                JOIN Producto pr ON dp.CodProductoFK = pr.CodProducto
                WHERE p.Estado = 'entregado' $fechaCondicion";
        
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    /**
     * Obtener ranking detallado con posiciones
     */
    public function obtenerRankingDetallado($periodo = 'month') {
        $productos = $this->obtenerMasVendidos($periodo, 20);
        $ranking = [];
        
        foreach($productos as $index => $producto) {
            $posicion = $index + 1;
            $producto['posicion'] = $posicion;
            $producto['categoria_ranking'] = $this->obtenerCategoriaRanking($posicion);
            $producto['porcentaje_ventas'] = 0; // Se calculará después
            $ranking[] = $producto;
        }
        
        // Calcular porcentajes
        $totalVentas = array_sum(array_column($ranking, 'total_vendidos'));
        if ($totalVentas > 0) {
            for ($i = 0; $i < count($ranking); $i++) {
                $ranking[$i]['porcentaje_ventas'] = round(($ranking[$i]['total_vendidos'] / $totalVentas) * 100, 2);
            }
        }
        
        return $ranking;
    }
    
    /**
     * Obtener comparativa entre períodos
     */
    public function obtenerComparativaPeriodos($productoId, $periodoActual = 'month', $periodoAnterior = 'month') {
        // Período actual
        $fechaActual = $this->obtenerCondicionFecha($periodoActual);
        $sqlActual = "SELECT 
                        COUNT(dp.CodProductoFK) as ventas_actuales,
                        SUM(dp.TotalProducto) as ingresos_actuales
                      FROM DetallePedido dp
                      JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito
                      WHERE dp.CodProductoFK = ? AND p.Estado = 'entregado' $fechaActual";
        
        $stmt = $this->db->prepare($sqlActual);
        $stmt->bind_param("i", $productoId);
        $stmt->execute();
        $actual = $stmt->get_result()->fetch_assoc();
        
        // Período anterior (calculado dinámicamente)
        $fechaAnterior = $this->obtenerCondicionFechaAnterior($periodoAnterior);
        $sqlAnterior = "SELECT 
                          COUNT(dp.CodProductoFK) as ventas_anteriores,
                          SUM(dp.TotalProducto) as ingresos_anteriores
                        FROM DetallePedido dp
                        JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito
                        WHERE dp.CodProductoFK = ? AND p.Estado = 'entregado' $fechaAnterior";
        
        $stmt = $this->db->prepare($sqlAnterior);
        $stmt->bind_param("i", $productoId);
        $stmt->execute();
        $anterior = $stmt->get_result()->fetch_assoc();
        
        // Calcular variaciones
        $ventasActuales = $actual['ventas_actuales'] ?? 0;
        $ventasAnteriores = $anterior['ventas_anteriores'] ?? 0;
        $ingresosActuales = $actual['ingresos_actuales'] ?? 0;
        $ingresosAnteriores = $anterior['ingresos_anteriores'] ?? 0;
        
        $variacionVentas = $ventasAnteriores > 0 ? 
            round((($ventasActuales - $ventasAnteriores) / $ventasAnteriores) * 100, 2) : 0;
        $variacionIngresos = $ingresosAnteriores > 0 ? 
            round((($ingresosActuales - $ingresosAnteriores) / $ingresosAnteriores) * 100, 2) : 0;
        
        return [
            'ventas_actuales' => $ventasActuales,
            'ventas_anteriores' => $ventasAnteriores,
            'ingresos_actuales' => $ingresosActuales,
            'ingresos_anteriores' => $ingresosAnteriores,
            'variacion_ventas' => $variacionVentas,
            'variacion_ingresos' => $variacionIngresos,
            'tendencia_ventas' => $variacionVentas >= 0 ? 'positiva' : 'negativa',
            'tendencia_ingresos' => $variacionIngresos >= 0 ? 'positiva' : 'negativa'
        ];
    }
    
    /**
     * Obtener productos con mejor rendimiento (relación precio/ventas)
     */
    public function obtenerMejorRendimiento($periodo = 'month', $limite = 5) {
        $fechaCondicion = $this->obtenerCondicionFecha($periodo);
        
        $sql = "SELECT 
                    pr.CodProducto,
                    pr.NombreProducto,
                    pr.Precio,
                    COUNT(dp.CodProductoFK) as total_vendidos,
                    SUM(dp.TotalProducto) as ingresos_totales,
                    (SUM(dp.TotalProducto) / COUNT(dp.CodProductoFK)) as ingreso_por_venta,
                    (COUNT(dp.CodProductoFK) * pr.Precio) as potencial_ingresos,
                    ROUND((SUM(dp.TotalProducto) / (COUNT(dp.CodProductoFK) * pr.Precio)) * 100, 2) as eficiencia_precio
                FROM Producto pr 
                JOIN DetallePedido dp ON pr.CodProducto = dp.CodProductoFK
                JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito
                WHERE p.Estado = 'entregado' $fechaCondicion
                GROUP BY pr.CodProducto
                HAVING total_vendidos >= 2
                ORDER BY eficiencia_precio DESC, total_vendidos DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Obtener tendencias de ventas por día de la semana
     */
    public function obtenerTendenciasSemana($periodo = 'month') {
        $fechaCondicion = $this->obtenerCondicionFecha($periodo);
        
        $sql = "SELECT 
                    DAYNAME(p.FechaYHoraEntrega) as dia_semana,
                    DAYOFWEEK(p.FechaYHoraEntrega) as numero_dia,
                    COUNT(dp.idDetalle) as total_ventas,
                    SUM(dp.TotalProducto) as ingresos_dia,
                    AVG(dp.TotalProducto) as promedio_venta,
                    COUNT(DISTINCT dp.CodProductoFK) as productos_diferentes
                FROM DetallePedido dp
                JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito
                WHERE p.Estado = 'entregado' $fechaCondicion
                GROUP BY DAYOFWEEK(p.FechaYHoraEntrega), DAYNAME(p.FechaYHoraEntrega)
                ORDER BY numero_dia";
        
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Obtener productos que están perdiendo ventas
     */
    public function obtenerProductosEnDeclive($limite = 5) {
        $sql = "SELECT 
                    pr.CodProducto,
                    pr.NombreProducto,
                    pr.Precio,
                    COUNT(CASE WHEN p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) THEN 1 END) as ventas_mes_actual,
                    COUNT(CASE WHEN p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH) 
                              AND p.FechaYHoraEntrega < DATE_SUB(CURDATE(), INTERVAL 1 MONTH) THEN 1 END) as ventas_mes_anterior,
                    MAX(p.FechaYHoraEntrega) as ultima_venta
                FROM Producto pr 
                LEFT JOIN DetallePedido dp ON pr.CodProducto = dp.CodProductoFK
                LEFT JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito AND p.Estado = 'entregado'
                GROUP BY pr.CodProducto
                HAVING ventas_mes_anterior > 0 AND ventas_mes_actual < ventas_mes_anterior
                ORDER BY (ventas_mes_anterior - ventas_mes_actual) DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Obtener análisis de precios vs ventas
     */
    public function obtenerAnalisisPrecios() {
        $sql = "SELECT 
                    CASE 
                        WHEN pr.Precio < 10000 THEN 'Económico (< $10,000)'
                        WHEN pr.Precio BETWEEN 10000 AND 30000 THEN 'Medio ($10,000 - $30,000)'
                        WHEN pr.Precio BETWEEN 30000 AND 50000 THEN 'Premium ($30,000 - $50,000)'
                        ELSE 'Luxury (> $50,000)'
                    END as rango_precio,
                    COUNT(DISTINCT pr.CodProducto) as productos_en_rango,
                    COUNT(dp.idDetalle) as total_ventas,
                    SUM(dp.TotalProducto) as ingresos_totales,
                    AVG(dp.TotalProducto) as ticket_promedio
                FROM Producto pr 
                LEFT JOIN DetallePedido dp ON pr.CodProducto = dp.CodProductoFK
                LEFT JOIN Pedidos p ON dp.idCarritoFK = p.idCarrito AND p.Estado = 'entregado'
                WHERE p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                GROUP BY rango_precio
                ORDER BY AVG(pr.Precio)";
        
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Métodos auxiliares privados
     */
    private function obtenerCondicionFecha($periodo) {
        switch($periodo) {
            case 'week':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
            case 'month':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            case 'quarter':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
            case 'year':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
            case 'today':
                return "AND DATE(p.FechaYHoraEntrega) = CURDATE()";
            default:
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        }
    }
    
    private function obtenerCondicionFechaAnterior($periodo) {
        switch($periodo) {
            case 'week':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK) 
                        AND p.FechaYHoraEntrega < DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
            case 'month':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH) 
                        AND p.FechaYHoraEntrega < DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            case 'quarter':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
                        AND p.FechaYHoraEntrega < DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
            case 'year':
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 2 YEAR) 
                        AND p.FechaYHoraEntrega < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
            default:
                return "AND p.FechaYHoraEntrega >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH) 
                        AND p.FechaYHoraEntrega < DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        }
    }
    
    private function obtenerCategoriaRanking($posicion) {
        if ($posicion <= 3) return 'top-3';
        if ($posicion <= 5) return 'top-5';
        if ($posicion <= 10) return 'top-10';
        return 'otros';
    }
    
    /**
     * Obtener resumen ejecutivo
     */
    public function obtenerResumenEjecutivo($periodo = 'month') {
        $estadisticas = $this->obtenerEstadisticasVentas($periodo);
        $masVendidos = $this->obtenerMasVendidos($periodo, 3);
        $mejorRendimiento = $this->obtenerMejorRendimiento($periodo, 3);
        $tendenciasSemana = $this->obtenerTendenciasSemana($periodo);
        
        return [
            'estadisticas_generales' => $estadisticas,
            'top_3_vendidos' => $masVendidos,
            'mejor_rendimiento' => $mejorRendimiento,
            'tendencias_semana' => $tendenciasSemana,
            'periodo_analizado' => $periodo,
            'fecha_reporte' => date('Y-m-d H:i:s')
        ];
    }
}
?>
