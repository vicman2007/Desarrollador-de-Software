<?php
require_once '../MODEL/database.php';
require_once '../MODEL/modelousu.php';

class UsuarioController {
    private $model;

    public function __CONSTRUCT() {
        $this->model = new Usuario();
    }

    public function Index() {
        $usuarios = $this->model->Listar();
        require_once '../VIEW/Usuario/admin-usuarios.php';
    }

    public function Guardar() {
        $alm = new Usuario();
        $alm->idUsuario        = $_REQUEST['idUsuario'];
        $alm->nombreUsuario    = $_REQUEST['nomU'];
        $alm->tipodocumento    = $_REQUEST['Tipodoc'];
        $alm->NoDoc            = $_REQUEST['numdoc'];
        $alm->correoUsuario    = $_REQUEST['correoUsuario'];
        $alm->direccionUsuario = $_REQUEST['direccion'];
        $alm->telefonoUsuario  = $_REQUEST['TelUsuario']; 
        $alm->estadoUsuario    = $_REQUEST['estadoUsuario'];
        $alm->contraseña       = $_REQUEST['contraUsuario'];
        $alm->idRolFK          = $_REQUEST['idRol'];

        if ($alm->idUsuario > 0) {
            $this->model->Actualizar($alm);
        } else {
            $this->model->Registrar($alm);
        }

        header('Location: ../VIEW/perfil/admin-perfil.php');
    }

    public function Eliminar() {
        $this->model->Eliminar($_REQUEST['idUsuario']);
        header('Location: ../VIEW/perfil/admin-perfil.php');
    }

    public function Editar() {
        $alm = isset($_REQUEST['idUsuario']) 
            ? $this->model->Obtener($_REQUEST['idUsuario']) 
            : new Usuario();
        require_once '../VIEW/usuario/usuario-editar.php';
    }

    public function ConsultarPorID() {
    $usuarios = [];

    if (!empty($_REQUEST['idUsuario'])) {
        $usuario = $this->model->Obtener($_REQUEST['idUsuario']);
        if ($usuario) {
            $usuarios[] = $usuario; 
        }
    } else {
        
        $usuarios = $this->model->Listar();
    }

    require_once '../VIEW/usuario/admin-usuarios.php';
}
}
?>
