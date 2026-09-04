<?php

namespace App\Controllers;

use App\Models\PedidoModel;

class Pedidos extends BaseController
{
    private PedidoModel $model;

    public function __construct()
    {
        $this->model = new PedidoModel();
    }

    public function index()
    {
        return view('admin/pedidos/index', [
            'title' => 'Pedidos | Misves',
            'pedidos' => $this->model->orderBy('idPedido', 'DESC')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/pedidos/form', ['title' => 'Nuevo pedido | Misves', 'pedido' => null]);
    }

    public function guardar()
    {
        if (! $this->validate([
            'idUsuario' => 'required|is_natural_no_zero',
            'TotalComprar' => 'required|decimal|greater_than_equal_to[0]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'idUsuario' => (int) $this->request->getPost('idUsuario'),
            'fechaPedido' => date('Y-m-d H:i:s'),
            'estado' => 'Pendiente',
            'TotalComprar' => (float) $this->request->getPost('TotalComprar'),
        ]);
        return redirect()->to(site_url('admin/pedidos'))->with('success', 'Pedido creado correctamente.');
    }

    public function editar(int $id)
    {
        $pedido = $this->model->find($id);
        if (! $pedido) {
            return redirect()->to(site_url('admin/pedidos'))->with('error', 'Pedido no encontrado.');
        }
        return view('admin/pedidos/form', ['title' => 'Editar pedido | Misves', 'pedido' => $pedido]);
    }

    public function actualizar(int $id)
    {
        if (! $this->model->find($id)) {
            return redirect()->to(site_url('admin/pedidos'))->with('error', 'Pedido no encontrado.');
        }
        if (! $this->validate([
            'estado' => 'required|in_list[Pendiente,En camino,Entregado,Cancelado]',
            'TotalComprar' => 'required|decimal|greater_than_equal_to[0]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->update($id, [
            'estado' => $this->request->getPost('estado'),
            'TotalComprar' => (float) $this->request->getPost('TotalComprar'),
        ]);
        return redirect()->to(site_url('admin/pedidos'))->with('success', 'Pedido actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->model->update($id, ['estado' => 'Cancelado']);
        return redirect()->to(site_url('admin/pedidos'))->with('success', 'Pedido cancelado.');
    }
}
