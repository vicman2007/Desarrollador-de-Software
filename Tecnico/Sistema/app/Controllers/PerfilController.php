<?php
require_once __DIR__ . '/../MODEL/PerfilModel.php';

class PerfilController {
    private $model;

    public function __construct() {
        $this->model = new PerfilModel();
    }

    public function Index() {
        session_start();
        $idUsuario = $_SESSION['idUsuario'] ?? null;

        if (!$idUsuario) {
            header("Location: ../login.php");
            exit();
        }

        
        $alm = $this->model->obtenerUsuario($idUsuario);

        return $alm; 
    }

    public function Guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'idUsuario' => $_POST['idUsuario'],
                'nomU' => $_POST['nomU'],
                'Tipodoc' => $_POST['Tipodoc'],
                'numdoc' => $_POST['numdoc'],
                'correoUsuario' => $_POST['correoUsuario'],
                'direccion' => $_POST['direccion'],
                'TelUsuario' => $_POST['TelUsuario']
            ];

            $this->model->actualizarUsuario($datos);

            header("Location: ../VIEW/perfil/admin-perfil.php");
            exit();
        }
    }
}

if (isset($_GET['f']) && $_GET['f'] === 'Guardar') {
    $controller = new PerfilController();
    $controller->Guardar();
}
