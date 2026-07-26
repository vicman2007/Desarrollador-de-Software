<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabla de resenas de productos.
 */
class CreateResenaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idResena'             => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'CalificacionProducto' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'ObservacionProducto'  => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'CodProductoFK'        => ['type' => 'INT', 'constraint' => 11, 'null' => true],
        ]);
        $this->forge->addKey('idResena', true);
        $this->forge->createTable('resena', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('resena', true);
    }
}
