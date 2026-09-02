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
            'idResena'     => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'idUsuario'    => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'idProducto'   => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'comentario'   => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'calificacion' => ['type' => 'INT', 'constraint' => 1, 'null' => false],
            'fecha'        => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('idResena', true);
        $this->forge->addForeignKey('idUsuario', 'usuario', 'idUsuario', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idProducto', 'producto', 'idProducto', 'CASCADE', 'CASCADE');
        $this->forge->createTable('resena', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('resena', true);
    }
}
