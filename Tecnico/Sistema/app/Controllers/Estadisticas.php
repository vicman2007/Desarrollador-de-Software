<?php
namespace App\Controllers;
use App\Models\PedidoModel;
use App\Models\ProductoModel;
class Estadisticas extends BaseController
{
 public function index(){return view('admin/estadisticas/index',['totalPedidos'=>(new PedidoModel())->countAll(),'productos'=>(new ProductoModel())->where('estado',1)->countAllResults()]);}
}
