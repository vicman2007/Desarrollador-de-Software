<?php

namespace App\Controllers;

use App\Models\ResenaModel;

class Resenas extends BaseController
{
    private ResenaModel $model;

    public function __construct()
    {
        $this->model = new ResenaModel();
    }

    public function index()
    {
        return view('admin/resenas/index', ['title' => 'Reseñas | Misves', 'resenas' => $this->model->orderBy('idResena', 'DESC')->findAll()]);
    }

    public function crear()
    {
        return view('admin/resenas/form', ['title' => 'Nueva reseña | Misves', 'resena' => null]);
    }

    public function guardar()
    {
        if (! $this->validate(['idUsuario' => 'required|is_natural_no_zero', 'idProducto' => 'required|is_natural_no_zero', 'comentario' => 'required|min_length[3]|max_length[500]', 'calificacion' => 'required|is_natural_no_zero|less_than_equal_to[5]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->insert(['idUsuario' => (int) $this->request->getPost('idUsuario'), 'idProducto' => (int) $this->request->getPost('idProducto'), 'comentario' => trim((string) $this->request->getPost('comentario')), 'calificacion' => (int) $this->request->getPost('calificacion'), 'fecha' => date('Y-m-d')]);
        return redirect()->to(site_url('admin/resenas'))->with('success', 'Reseña guardada correctamente.');
    }

    public function editar(int $id)
    {
        $resena = $this->model->find($id);
        if (! $resena) return redirect()->to(site_url('admin/resenas'))->with('error', 'Reseña no encontrada.');
        return view('admin/resenas/form', ['title' => 'Editar reseña | Misves', 'resena' => $resena]);
    }

    public function actualizar(int $id)
    {
        if (! $this->model->find($id)) return redirect()->to(site_url('admin/resenas'))->with('error', 'Reseña no encontrada.');
        if (! $this->validate(['comentario' => 'required|min_length[3]|max_length[500]', 'calificacion' => 'required|is_natural_no_zero|less_than_equal_to[5]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->update($id, ['comentario' => trim((string) $this->request->getPost('comentario')), 'calificacion' => (int) $this->request->getPost('calificacion')]);
        return redirect()->to(site_url('admin/resenas'))->with('success', 'Reseña actualizada correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('admin/resenas'))->with('success', 'Reseña eliminada.');
    }
}
