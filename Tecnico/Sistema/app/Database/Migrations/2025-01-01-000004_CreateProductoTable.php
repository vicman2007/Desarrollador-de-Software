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
            'idProducto'   => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nombre'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'descripcion'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'precio'       => ['type' => 'DOUBLE', 'null' => false, 'default' => 0],
            'imagen'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'estado'       => ['type' => 'INT', 'constraint' => 1, 'null' => false, 'default' => 1],
        ]);
        $this->forge->addKey('idProducto', true);
        $this->forge->createTable('producto', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('producto', true);
    }
}
