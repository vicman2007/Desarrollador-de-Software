<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['idRol' => 1, 'DescripcionRol' => 'cliente'],
            ['idRol' => 2, 'DescripcionRol' => 'administrador'],
            ['idRol' => 3, 'DescripcionRol' => 'domiciliario'],
        ];

        $this->db->table('rol')->ignore(true)->insertBatch($data);
    }
}
