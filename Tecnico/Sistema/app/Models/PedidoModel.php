<?php
require_once 'database.php';

class Pedido 
{
    public $idCarrito;
    public $nombreUsuario;
    public $productosAñadidos;
    public $Estado;
    public $DireccionEntrega;
    public $FechaYHoraEntrega;
    public $FormaPago;
    public $idUsuarioFK;

    private $pdo;

    public function __construct() 
    {
        try {
            $database = new Database();
            $this->pdo = $database->StartUp();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    // Listar todos los pedidos
    public function Listar() 
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM Pedidos");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Obtener pedido por ID
    public function Obtener($idCarrito) 
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM Pedidos WHERE idCarrito = ?");
            $stm->execute([$idCarrito]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Eliminar pedido
    public function Eliminar($idCarrito) 
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM Pedidos WHERE idCarrito = ?");
            $stm->execute([$idCarrito]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Actualizar pedido
    public function Actualizar($data) 
    {
        try {
            $sql = "UPDATE Pedidos SET 
                        nombreUsuario=?, 
                        productosAñadidos=?, 
                        Estado=?, 
                        DireccionEntrega=?, 
                        FechaYHoraEntrega=?, 
                        FormaPago=?, 
                        idUsuarioFK=?
                    WHERE idCarrito=?";

            $this->pdo->prepare($sql)->execute([
                $data->nombreUsuario,
                $data->productosAñadidos,
                $data->Estado,
                $data->DireccionEntrega,
                $data->FechaYHoraEntrega,
                $data->FormaPago,
                $data->idUsuarioFK,
                $data->idCarrito
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        } 
    }

    public function Registrar($data) 
    {
        try{
            $sql = "INSERT INTO Pedidos 
                    (nombreUsuario, productosAñadidos, Estado, DireccionEntrega, FechaYHoraEntrega, FormaPago, idUsuarioFK) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)->execute([
                $data->nombreUsuario,
                $data->productosAñadidos,
                $data->Estado,
                $data->DireccionEntrega,
                $data->FechaYHoraEntrega,
                $data->FormaPago,
                $data->idUsuarioFK
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
