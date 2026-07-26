<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabla de pedidos / carritos.
 */
class CreatePedidosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idCarrito'         => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nombreUsuario'     => ['type' => 'VARCHAR', 'constraint' => 60, 'null' => true],
            'productosAnadidos' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'Estado'            => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true, 'default' => 'realizado'],
            'DireccionEntrega'  => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'FechaYHoraEntrega' => ['type' => 'DATETIME', 'null' => true],
            'FormaPago'         => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'TotalComprar'      => ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
            'idUsuarioFK'       => ['type' => 'INT', 'constraint' => 11, 'null' => true],
        ]);
        $this->forge->addKey('idCarrito', true);
        $this->forge->addForeignKey('idUsuarioFK', 'usuario', 'idUsuario', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pedidos', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedidos', true);
    }
}
