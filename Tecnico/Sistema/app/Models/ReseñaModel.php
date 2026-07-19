<?php
class ReseñaModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "misves");

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function obtenerResenas() {
        $sql = "SELECT * FROM Reseña";
        $resultado = $this->conexion->query($sql);
        $resenas = [];

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $resenas[] = $fila;
            }
        }

        return $resenas;
    }

    public function obtenerResenaPorId($idReseña) {
        $stmt = $this->conexion->prepare("SELECT * FROM Reseña WHERE idReseña = ?");
        $stmt->bind_param("i", $idReseña);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows > 0) {
            $resena = $resultado->fetch_assoc();
            $stmt->close();
            return $resena;
        }

        $stmt->close();
        return null;
    }

    public function insertarResena($CalificacionProducto, $ObservacionProducto, $CodProductoFK) {
        $stmt = $this->conexion->prepare("INSERT INTO Reseña (CalificacionProducto, ObservacionProducto, CodProductoFK) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $CalificacionProducto, $ObservacionProducto, $CodProductoFK);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function editarResena($idReseña, $CalificacionProducto, $ObservacionProducto, $CodProductoFK) {
        $stmt = $this->conexion->prepare("UPDATE Reseña SET CalificacionProducto = ?, ObservacionProducto = ?, CodProductoFK = ? WHERE idReseña = ?");
        $stmt->bind_param("isii", $CalificacionProducto, $ObservacionProducto, $CodProductoFK, $idReseña);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function borrarResena($idReseña) {
        $stmt = $this->conexion->prepare("DELETE FROM Reseña WHERE idReseña = ?");
        $stmt->bind_param("i", $idReseña);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
}
?>
