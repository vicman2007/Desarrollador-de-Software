<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'apellido', 'correo', 'contrasena', 'idRol', 'estado'];
    protected $useTimestamps = false;

    public function porCorreo(string $correo): ?array
    {
        return $this->where('correo', strtolower(trim($correo)))->first();
    }
}
