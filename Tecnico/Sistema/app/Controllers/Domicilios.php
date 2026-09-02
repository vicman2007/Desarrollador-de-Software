<?php
namespace App\Controllers;
use App\Models\PedidoModel;
class Domicilios extends BaseController
{
 public function index(){return view('admin/domicilios/index',['pedidos'=>(new PedidoModel())->whereIn('estado',['Pendiente','En camino'])->findAll()]);}
 public function filtrar(string $estado){return view('admin/domicilios/index',['pedidos'=>(new PedidoModel())->where('estado',$estado)->findAll()]);}
 public function actualizarEstado(){(new PedidoModel())->update((int)$this->request->getPost('idPedido'),['estado'=>$this->request->getPost('estado')]);return redirect()->to('/domicilios')->with('success','Estado actualizado.');}
}
