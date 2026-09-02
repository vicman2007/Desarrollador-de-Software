<?php
namespace App\Controllers;
use App\Models\PedidoModel;
class Pedidos extends BaseController
{
 public function index(){return view('admin/pedidos/index',['pedidos'=>(new PedidoModel())->orderBy('idPedido','DESC')->findAll()]);}
 public function crear(){return view('admin/pedidos/form',['pedido'=>null]);}
 public function guardar(){(new PedidoModel())->insert(['idUsuario'=>(int)$this->request->getPost('idUsuario'),'fechaPedido'=>date('Y-m-d H:i:s'),'estado'=>'Pendiente','TotalComprar'=>(float)$this->request->getPost('TotalComprar')]);return redirect()->to('/admin/pedidos')->with('success','Pedido creado.');}
 public function editar(int $id){return view('admin/pedidos/form',['pedido'=>(new PedidoModel())->find($id)]);}
 public function actualizar(int $id){(new PedidoModel())->update($id,['estado'=>$this->request->getPost('estado'),'TotalComprar'=>(float)$this->request->getPost('TotalComprar')]);return redirect()->to('/admin/pedidos')->with('success','Pedido actualizado.');}
 public function eliminar(int $id){(new PedidoModel())->delete($id);return redirect()->to('/admin/pedidos')->with('success','Pedido eliminado.');}
}
