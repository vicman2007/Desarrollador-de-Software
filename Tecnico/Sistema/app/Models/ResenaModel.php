<?php

namespace App\Models;

use CodeIgniter\Model;

class ResenaModel extends Model
{
    protected $table = 'resena';
    protected $primaryKey = 'idResena';
    protected $returnType = 'array';
    protected $allowedFields = ['idUsuario', 'idProducto', 'comentario', 'calificacion', 'fecha'];
    protected $useTimestamps = false;
}
