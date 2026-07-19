<?php
class PerfilModel {
    private $conexion;
    
    // Constructor para conectar a la base de datos
    public function __construct() {
        $this->conectar();
    }
    
    // Método para conectar a la base de datos
    private function conectar() {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $baseDatos = "misves";
        
        try {
            $this->conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
    
    // Método para obtener los datos del usuario por ID
    public function obtenerUsuario($idUsuario) {
        try {
            $consulta = "SELECT * FROM Usuario WHERE idUsuario = :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
            return $resultado;
            
        } catch(PDOException $e) {
            echo "Error al obtener usuario: " . $e->getMessage();
            return false;
        }
    }
    
    // Método para actualizar los datos del usuario
    public function actualizarUsuario($datos) {
        try {
            $consulta = "UPDATE Usuario SET 
                        nombreUsuario = :nombre,
                        tipodocumento = :tipoDoc,
                        NoDoc = :numDoc,
                        correoUsuario = :correo,
                        direccionUsuario = :direccion,
                        telefonoUsuario = :telefono
                        WHERE idUsuario = :idUsuario";
            
            $stmt = $this->conexion->prepare($consulta);
            
            // Vincular los parámetros
            $stmt->bindParam(':nombre', $datos['nomU']);
            $stmt->bindParam(':tipoDoc', $datos['Tipodoc']);
            $stmt->bindParam(':numDoc', $datos['numdoc']);
            $stmt->bindParam(':correo', $datos['correoUsuario']);
            $stmt->bindParam(':direccion', $datos['direccion']);
            $stmt->bindParam(':telefono', $datos['TelUsuario']);
            $stmt->bindParam(':idUsuario', $datos['idUsuario']);
            
            $resultado = $stmt->execute();
            return $resultado;
            
        } catch(PDOException $e) {
            echo "Error al actualizar usuario: " . $e->getMessage();
            return false;
        }
    }
    
    // Método para verificar si el correo ya existe (para otro usuario)
    public function verificarCorreoExiste($correo, $idUsuario) {
        try {
            $consulta = "SELECT COUNT(*) as total FROM Usuario WHERE correoUsuario = :correo AND idUsuario != :idUsuario";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
            return $resultado->total > 0;
            
        } catch(PDOException $e) {
            echo "Error al verificar correo: " . $e->getMessage();
            return false;
        }
    }
    
    // Método para cerrar la conexión
    public function cerrarConexion() {
        $this->conexion = null;
    }
}
?>
