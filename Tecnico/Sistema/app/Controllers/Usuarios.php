<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
class Usuarios extends BaseController
{
 public function index(){return view('admin/usuarios/index',['usuarios'=>(new UsuarioModel())->orderBy('idUsuario','DESC')->findAll()]);}
 public function crear(){return view('admin/usuarios/form',['usuario'=>null]);}
 public function guardar(){ $m=new UsuarioModel(); $m->insert(['nombre'=>$this->request->getPost('nombre'),'apellido'=>$this->request->getPost('apellido'),'correo'=>strtolower($this->request->getPost('correo')),'contrasena'=>password_hash($this->request->getPost('contrasena'),PASSWORD_DEFAULT),'idRol'=>(int)$this->request->getPost('idRol'),'estado'=>1]); return redirect()->to('/admin/usuarios')->with('success','Usuario creado.'); }
 public function editar(int $id){return view('admin/usuarios/form',['usuario'=>(new UsuarioModel())->find($id)]);}
 public function actualizar(int $id){$data=['nombre'=>$this->request->getPost('nombre'),'apellido'=>$this->request->getPost('apellido'),'correo'=>strtolower($this->request->getPost('correo')),'idRol'=>(int)$this->request->getPost('idRol'),'estado'=>(int)$this->request->getPost('estado')]; if($this->request->getPost('contrasena'))$data['contrasena']=password_hash($this->request->getPost('contrasena'),PASSWORD_DEFAULT); (new UsuarioModel())->update($id,$data); return redirect()->to('/admin/usuarios')->with('success','Usuario actualizado.');}
 public function eliminar(int $id){(new UsuarioModel())->update($id,['estado'=>0]);return redirect()->to('/admin/usuarios')->with('success','Usuario desactivado.');}
}
