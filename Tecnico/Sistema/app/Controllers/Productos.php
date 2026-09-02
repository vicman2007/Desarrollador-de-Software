<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Productos extends BaseController
{
    private ProductoModel $model;
    public function __construct() { $this->model = new ProductoModel(); }
    public function index() { return view('admin/productos/index', ['productos' => $this->model->orderBy('idProducto', 'DESC')->findAll()]); }
    public function crear() { return view('admin/productos/form', ['producto' => null]); }
    public function guardar()
    {
        $rules = ['nombre' => 'required|max_length[120]', 'precio' => 'required|decimal'];
        if (! $this->validate($rules)) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $this->model->insert(['nombre' => trim($this->request->getPost('nombre')), 'descripcion' => trim($this->request->getPost('descripcion') ?? ''), 'precio' => $this->request->getPost('precio'), 'imagen' => trim($this->request->getPost('imagen') ?? ''), 'estado' => 1]);
        return redirect()->to('/admin/productos')->with('success', 'Producto creado.');
    }
    public function editar(int $id) { return view('admin/productos/form', ['producto' => $this->model->find($id)]); }
    public function actualizar(int $id)
    {
        if (! $this->validate(['nombre' => 'required|max_length[120]', 'precio' => 'required|decimal'])) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $this->model->update($id, ['nombre' => trim($this->request->getPost('nombre')), 'descripcion' => trim($this->request->getPost('descripcion') ?? ''), 'precio' => $this->request->getPost('precio'), 'imagen' => trim($this->request->getPost('imagen') ?? ''), 'estado' => (int) $this->request->getPost('estado')]);
        return redirect()->to('/admin/productos')->with('success', 'Producto actualizado.');
    }
    public function eliminar(int $id) { $this->model->update($id, ['estado' => 0]); return redirect()->to('/admin/productos')->with('success', 'Producto desactivado.'); }
}
