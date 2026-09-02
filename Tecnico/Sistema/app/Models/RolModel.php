<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'idRol';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre'];
    protected $useTimestamps = false;
}
