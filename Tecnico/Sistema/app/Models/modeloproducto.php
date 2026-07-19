<?php
require_once 'database.php';

class Producto
{
    public $CodProducto;
    public $NombreProducto;
    public $DescripcionProducto;
    public $Precio;
    public $ImagenProducto;
    public $stock;
    public $EstadoProducto;
    public $idReseñaFK;

    private $pdo;

    public function __CONSTRUCT()
    {
        try {
            $database = new Database();
            $this->pdo = $database->StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Listar todos los productos
    public function Listar()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM Producto");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Obtener un producto por ID
    public function Obtener($CodProducto)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM Producto WHERE CodProducto = ?");
            $stm->execute([$CodProducto]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Eliminar un producto
    public function Eliminar($CodProducto)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM Producto WHERE CodProducto = ?");
            $stm->execute([$CodProducto]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Actualizar un producto
    public function Actualizar($data)
    {
        try {
            if (!empty($data->ImagenProducto)) {
                $sql = "UPDATE Producto SET 
                            NombreProducto = ?,
                            DescripcionProducto = ?,
                            Precio = ?,
                            ImagenProducto = ?,
                            stock = ?,
                            EstadoProducto = ?,
                            idReseñaFK = ?
                        WHERE CodProducto = ?";
                $this->pdo->prepare($sql)->execute([
                    $data->NombreProducto,
                    $data->DescripcionProducto,
                    $data->Precio,
                    $data->ImagenProducto,
                    $data->stock,
                    $data->EstadoProducto,
                    $data->idReseñaFK,
                    $data->CodProducto
                ]);
            } else {
                $sql = "UPDATE Producto SET 
                            NombreProducto = ?,
                            DescripcionProducto = ?,
                            Precio = ?,
                            stock = ?,
                            EstadoProducto = ?,
                            idReseñaFK = ?
                        WHERE CodProducto = ?";
                $this->pdo->prepare($sql)->execute([
                    $data->NombreProducto,
                    $data->DescripcionProducto,
                    $data->Precio,
                    $data->stock,
                    $data->EstadoProducto,
                    $data->idReseñaFK,
                    $data->CodProducto
                ]);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Registrar un nuevo producto
    public function Registrar($data)
    {
        try {
            $sql = "INSERT INTO Producto 
                    (NombreProducto, DescripcionProducto, Precio, ImagenProducto, stock, EstadoProducto, idReseñaFK)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $this->pdo->prepare($sql)->execute([
                $data->NombreProducto,
                $data->DescripcionProducto,
                $data->Precio,
                $data->ImagenProducto,
                $data->stock,
                $data->EstadoProducto,
                $data->idReseñaFK
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
