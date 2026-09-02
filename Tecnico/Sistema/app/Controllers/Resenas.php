<?php
namespace App\Controllers;
use App\Models\ResenaModel;
class Resenas extends BaseController
{
 public function index(){return view('admin/resenas/index',['resenas'=>(new ResenaModel())->orderBy('idResena','DESC')->findAll()]);}
 public function crear(){return view('admin/resenas/form',['resena'=>null]);}
 public function guardar(){(new ResenaModel())->insert(['idUsuario'=>(int)$this->request->getPost('idUsuario'),'idProducto'=>(int)$this->request->getPost('idProducto'),'comentario'=>trim($this->request->getPost('comentario')),'calificacion'=>(int)$this->request->getPost('calificacion'),'fecha'=>date('Y-m-d')]);return redirect()->to('/admin/resenas')->with('success','Reseña guardada.');}
 public function editar(int $id){return view('admin/resenas/form',['resena'=>(new ResenaModel())->find($id)]);}
 public function actualizar(int $id){(new ResenaModel())->update($id,['comentario'=>trim($this->request->getPost('comentario')),'calificacion'=>(int)$this->request->getPost('calificacion')]);return redirect()->to('/admin/resenas')->with('success','Reseña actualizada.');}
 public function eliminar(int $id){(new ResenaModel())->delete($id);return redirect()->to('/admin/resenas')->with('success','Reseña eliminada.');}
}
