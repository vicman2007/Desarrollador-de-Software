<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'idProducto';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'descripcion', 'precio', 'imagen', 'estado'];
    protected $useTimestamps = false;
}
