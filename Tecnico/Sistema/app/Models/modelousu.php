<?php
require_once 'database.php';

class Usuario
{
    public $idUsuario;
    public $nombreUsuario;
    public $tipodocumento;
    public $NoDoc;
    public $correoUsuario;
    public $direccionUsuario;
    public $telefonoUsuario; 
    public $estadoUsuario;
    public $contraseña;
    public $idRolFK;

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

    public function Listar()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM usuario");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($idUsuario)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
            $stm->execute([$idUsuario]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($idUsuario)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM usuario WHERE idUsuario = ?");
            $stm->execute([$idUsuario]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE usuario SET 
                        nombreUsuario = ?,
                        tipodocumento = ?,
                        NoDoc = ?,
                        correoUsuario = ?,
                        direccionUsuario = ?,
                        telefonoUsuario = ?, 
                        estadoUsuario = ?,
                        contraseña = ?,
                        idRolFK = ?
                    WHERE idUsuario = ?";

            $this->pdo->prepare($sql)->execute([
                $data->nombreUsuario,
                $data->tipodocumento,
                $data->NoDoc,
                $data->correoUsuario,
                $data->direccionUsuario,
                $data->telefonoUsuario, // <- corregido
                $data->estadoUsuario,
                $data->contraseña,
                $data->idRolFK,
                $data->idUsuario
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar($data)
    {
        try {
            $sql = "INSERT INTO usuario 
                    (nombreUsuario, tipodocumento, NoDoc, correoUsuario, direccionUsuario, telefonoUsuario, estadoUsuario, contraseña, idRolFK) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)->execute([
                $data->nombreUsuario,
                $data->tipodocumento,
                $data->NoDoc,
                $data->correoUsuario,
                $data->direccionUsuario,
                $data->telefonoUsuario, 
                $data->estadoUsuario,
                $data->contraseña,
                $data->idRolFK
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
