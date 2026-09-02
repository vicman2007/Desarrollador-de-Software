<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'idPedido';
    protected $returnType = 'array';
    protected $allowedFields = ['idUsuario', 'fechaPedido', 'estado', 'TotalComprar'];
    protected $useTimestamps = false;
}
