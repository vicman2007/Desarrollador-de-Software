<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Productos extends BaseController
{
    private ProductoModel $model;

    public function __construct()
    {
        $this->model = new ProductoModel();
    }

    public function index()
    {
        return view('admin/productos/index', [
            'title' => 'Productos | Misves',
            'productos' => $this->model->orderBy('idProducto', 'DESC')->findAll(),
        ]);
    }

    public function crear()
    {
        return view('admin/productos/form', ['title' => 'Nuevo producto | Misves', 'producto' => null]);
    }

    public function guardar()
    {
        if (! $this->validateProducto()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->productoData());
        return redirect()->to(site_url('admin/productos'))->with('success', 'Producto creado correctamente.');
    }

    public function editar(int $id)
    {
        $producto = $this->model->find($id);
        if (! $producto) {
            return redirect()->to(site_url('admin/productos'))->with('error', 'Producto no encontrado.');
        }
        return view('admin/productos/form', ['title' => 'Editar producto | Misves', 'producto' => $producto]);
    }

    public function actualizar(int $id)
    {
        if (! $this->model->find($id)) {
            return redirect()->to(site_url('admin/productos'))->with('error', 'Producto no encontrado.');
        }
        if (! $this->validateProducto()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->update($id, $this->productoData(false));
        return redirect()->to(site_url('admin/productos'))->with('success', 'Producto actualizado correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->model->update($id, ['estado' => 0]);
        return redirect()->to(site_url('admin/productos'))->with('success', 'Producto desactivado.');
    }

    private function validateProducto(): bool
    {
        return $this->validate([
            'nombre' => 'required|min_length[2]|max_length[100]',
            'descripcion' => 'permit_empty|max_length[255]',
            'precio' => 'required|decimal|greater_than[0]',
            'imagen' => 'permit_empty|max_length[255]',
        ]);
    }

    private function productoData(bool $includeEstado = true): array
    {
        $data = [
            'nombre' => trim((string) $this->request->getPost('nombre')),
            'descripcion' => trim((string) $this->request->getPost('descripcion')),
            'precio' => (float) $this->request->getPost('precio'),
            'imagen' => trim((string) $this->request->getPost('imagen')),
        ];
        if ($includeEstado) {
            $data['estado'] = 1;
        } else {
            $data['estado'] = (int) ($this->request->getPost('estado') ?? 1);
        }
        return $data;
    }
}
