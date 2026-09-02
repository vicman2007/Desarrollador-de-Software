<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('producto')->insertBatch([
            ['nombre' => 'Gelatina de frutas', 'descripcion' => 'Gelatina artesanal con frutas frescas.', 'precio' => 8500, 'imagen' => 'gelatina.jpeg', 'estado' => 1],
            ['nombre' => 'Torta de limón', 'descripcion' => 'Bizcocho suave con crema de limón.', 'precio' => 18000, 'imagen' => 'limon.jpeg', 'estado' => 1],
            ['nombre' => 'Torta de maracuyá', 'descripcion' => 'Torta cremosa con maracuyá natural.', 'precio' => 22000, 'imagen' => 'maracuya.jpg', 'estado' => 1],
            ['nombre' => 'Tiramisú', 'descripcion' => 'Clásico tiramisú con café y cacao.', 'precio' => 24000, 'imagen' => 'tiramisu.jpeg', 'estado' => 1],
            ['nombre' => 'Fresas con barquillos', 'descripcion' => 'Fresas frescas con crema y barquillos.', 'precio' => 15000, 'imagen' => 'barquillos.jpeg', 'estado' => 1],
            ['nombre' => 'Postre M&M', 'descripcion' => 'Postre de chocolate con M&M.', 'precio' => 16000, 'imagen' => 'mym.jpeg', 'estado' => 1],
        ]);
    }
}
