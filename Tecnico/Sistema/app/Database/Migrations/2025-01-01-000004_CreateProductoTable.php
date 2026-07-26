<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabla de productos (postres, tortas, etc.).
 * ImagenProducto guarda una ruta relativa dentro de public/uploads/productos.
 */
class CreateProductoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'CodProducto'         => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'NombreProducto'      => ['type' => 'VARCHAR', 'constraint' => 60, 'null' => true],
            'DescripcionProducto' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'Precio'              => ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
            'ImagenProducto'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'stock'               => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'default' => 0],
            'EstadoProducto'      => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true, 'default' => 'Disponible'],
            'idResenaFK'          => ['type' => 'INT', 'constraint' => 11, 'null' => true],
        ]);
        $this->forge->addKey('CodProducto', true);
        $this->forge->createTable('producto', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('producto', true);
    }
}
