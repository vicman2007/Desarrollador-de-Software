<?php
require_once '../MODEL/database.php';
require_once '../MODEL/modeloproducto.php';

class ProductoController {
    private $model;

    public function __CONSTRUCT() {
        $this->model = new Producto();
    }

    
    public function Index() {
        $productos = $this->model->Listar();
        require '../VIEW/producto/admin-producto.php';
    }

    public function Guardar() {
        $alm = new Producto();

        $alm->CodProducto       = $_REQUEST['CodProducto'];
        $alm->NombreProducto    = $_REQUEST['NombreProducto'];
        $alm->DescripcionProducto = $_REQUEST['DescripcionProducto'];
        $alm->Precio            = $_REQUEST['Precio'];
        $alm->stock             = $_REQUEST['stock'];
        $alm->EstadoProducto    = $_REQUEST['EstadoProducto'];
        $alm->idReseñaFK        = $_REQUEST['idReseñaFK'];

      
        if (!empty($_FILES['ImagenProducto']['tmp_name'])) {
        $alm->ImagenProducto = file_get_contents($_FILES['ImagenProducto']['tmp_name']);
    } else {
       
        if (!empty($_POST['CodProducto'])) {
            $productoExistente = $this->model->Obtener($_POST['CodProducto']);
            $alm->ImagenProducto = $productoExistente->ImagenProducto;
        }
    }

        if (!empty($alm->CodProducto) && $alm->CodProducto > 0) {
            $this->model->Actualizar($alm);
        } else {
            $this->model->Registrar($alm);
        }

        header('Location: ../VIEW/producto.php');
        exit;
    }


    public function Eliminar() {
        $this->model->Eliminar($_REQUEST['CodProducto']);
        header('Location: ../VIEW/producto/admin-producto.php');
        exit;
    }

    public function Editar() {
        $alm = isset($_REQUEST['CodProducto']) 
            ? $this->model->Obtener($_REQUEST['CodProducto']) 
            : new Producto();
        require '../VIEW/producto/producto-editar.php';
    }

    public function ConsultarPorID() {
        $productos = [];

        if (!empty($_REQUEST['CodProducto'])) {
            $producto = $this->model->Obtener($_REQUEST['CodProducto']);
            if ($producto) {
                $productos[] = $producto;
            }
        } else {
            $productos = $this->model->Listar();
        }

        require '../VIEW/producto/admin-producto.php';
    }
}
?>
