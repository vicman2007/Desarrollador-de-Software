<?php
require_once '../MODEL/database.php';
require_once '../MODEL/PedidoModel.php';

class Pedidocontroller {
    private $model;

    public function __construct() {
        $this->model = new Pedido();
    }

    public function Index() {
        $pedidos = $this->model->Listar();
        require '../VIEW/pedido/admin-pedidos.php';
    }

    public function Guardar() {
        $alm = new Pedido();
        $alm->idCarrito          = isset($_REQUEST['idCarrito']) && $_REQUEST['idCarrito'] != '' ? $_REQUEST['idCarrito'] : 0;
        $alm->nombreUsuario      = $_REQUEST['nombreUsuario'];
        $alm->productosAñadidos  = $_REQUEST['productosAñadidos'];
        $alm->Estado             = $_REQUEST['Estado'];
        $alm->DireccionEntrega   = $_REQUEST['DireccionEntrega'];
        $alm->FechaYHoraEntrega  = $_REQUEST['FechaYHoraEntrega'];
        $alm->FormaPago          = $_REQUEST['FormaPago'];
        $alm->idUsuarioFK        = $_REQUEST['idUsuarioFK'];

        if ($alm->idCarrito > 0) {
            $this->model->Actualizar($alm);
        } else {
            $this->model->Registrar($alm);
        }

        header('Location: ../VIEW/perfil/admin-perfil.php');
        exit();
    }

    public function Eliminar() {
        $this->model->Eliminar($_REQUEST['idCarrito']);
        header('Location: ../VIEW/perfil/admin-perfil.php');
        exit();
    }

    public function Editar() {
        $alm = isset($_REQUEST['idCarrito']) 
            ? $this->model->Obtener($_REQUEST['idCarrito']) 
            : new Pedido();
        require_once '../VIEW/pedido/pedido-editar.php';
    }

    public function ConsultarPorID() {
        $pedidos = [];

        if (!empty($_REQUEST['idCarrito'])) {
            $pedido = $this->model->Obtener($_REQUEST['idCarrito']);
            if ($pedido) {
                $pedidos[] = $pedido; 
            }
        } else {
            $pedidos = $this->model->Listar();
        }

        require_once '../VIEW/pedido/admin-pedidos.php';
    }
}
?>
