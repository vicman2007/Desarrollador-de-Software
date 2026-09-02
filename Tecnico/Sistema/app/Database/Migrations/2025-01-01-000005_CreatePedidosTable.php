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
            'idPedido'    => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'idUsuario'   => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'fechaPedido' => ['type' => 'DATETIME', 'null' => false],
            'estado'      => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => false, 'default' => 'Pendiente'],
            'TotalComprar'=> ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
        ]);
        $this->forge->addKey('idPedido', true);
        $this->forge->addForeignKey('idUsuario', 'usuario', 'idUsuario', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pedido', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedido', true);
    }
}
