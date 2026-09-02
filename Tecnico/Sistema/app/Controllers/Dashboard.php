<?php

namespace App\Controllers;

use App\Models\PedidoModel;
use App\Models\ProductoModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productos = new ProductoModel();
        $pedidos = new PedidoModel();
        return view('dashboard/index', ['stats' => ['productos' => $productos->where('estado', 1)->countAllResults(), 'pedidos' => $pedidos->countAllResults(), 'pendientes' => $pedidos->where('estado', 'Pendiente')->countAllResults()], 'ultimos' => $pedidos->orderBy('idPedido', 'DESC')->findAll(5)]);
    }
}
