<?php

namespace App\Models;

use CodeIgniter\Model;

class DetallePedidoModel extends Model
{
    protected $table = 'detallepedido';
    protected $primaryKey = 'idDetallePedido';
    protected $returnType = 'array';
    protected $allowedFields = ['idPedido', 'idProducto', 'cantidad', 'precioUnitario', 'TotalComprar'];
    protected $useTimestamps = false;
}
