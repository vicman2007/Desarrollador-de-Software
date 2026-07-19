<?php

require_once('database.php');

class modeloUsuario extends database
 
{
    private $idUsuario;
    private $nombreUsuario;
    private $tipodocumento;
    private $NoDoc;
    private $correoUsuario;
    private $dirreccionUsuario;
    private $telefonoUsuario;
    private $estadoUsuario;
    private $contraseña;
    private $idRolFK;

    function __construct($idUsuarioIN,$nombreUsuarioIN,$tipodocumentoIN,$NoDocIN,$correoUsuarioIN,$dirreccionUsuarioIN,$telefonoUsuarioIN,$estadoUsuarioIN,$contraseñaIN,$idRolFKIN)
    {
        $this->idUsuario = $idUsuarioIN;
        $this->nombreUsuario = $nombreUsuarioIN;
        $this->tipodocumento=$tipodocumento;
        $this->NoDoc=$NoDoc ;
        $this->correoUsuario = $correoUsuarioIN;
        $this->dirreccionUsuario = $dirreccionUsuarioIN;
        $this->telefonoUsuario = $telefonoUsuarioIN;
        $this->estadoUsuario = $estadoUsuarioIN;
        $this->contraseña = $contraseña;
        $this->idRolFK = $idRolFK;
    }

    public function consultalogin() {
        

        $objConexion = new database();
        $objPDO = $objConexion->Startup();

        try{
            $sql = $objPDO->prepare("SELECT correoUsuario,estadoUsuario,contraseña,idRolFK FROM usuario WHERE correoUsuario = :correoUsuario");

            $sql->bindParam(':correoUsuario', $this->correoUsuario);
             $sql->execute(); 
                return $sql->fetch(PDO::FETCH_OBJ); 
                $objPDO = $objConexion::desconectar(); 
            } catch (\Throwable $error) {
                echo 'ERROR: '. $error->getMessage();  
                die();
        }
    }
}
?>