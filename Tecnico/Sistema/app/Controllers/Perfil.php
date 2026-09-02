<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
class Perfil extends BaseController
{
 public function index(){return view('perfil/index',['usuario'=>(new UsuarioModel())->find($this->session->get('idUsuario'))]);}
 public function actualizar(){ $id=$this->session->get('idUsuario'); (new UsuarioModel())->update($id,['nombre'=>trim($this->request->getPost('nombre')),'apellido'=>trim($this->request->getPost('apellido'))]); $this->session->set(['nombre'=>trim($this->request->getPost('nombre'))]); return redirect()->to('/perfil')->with('success','Perfil actualizado.'); }
 public function cambiarPassword(){ $m=new UsuarioModel(); $u=$m->find($this->session->get('idUsuario')); if(!$u||!password_verify($this->request->getPost('actual'),$u['contrasena'])) return redirect()->back()->with('error','La contraseña actual no es válida.'); $m->update($u['idUsuario'],['contrasena'=>password_hash($this->request->getPost('nueva'),PASSWORD_DEFAULT)]); return redirect()->back()->with('success','Contraseña actualizada.'); }
}
