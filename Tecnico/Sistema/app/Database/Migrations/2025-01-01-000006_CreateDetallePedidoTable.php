<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabla de detalle de pedidos (lineas de cada carrito).
 */
class CreateDetallePedidoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDetallePedido' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'idPedido'        => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'idProducto'      => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'cantidad'        => ['type' => 'INT', 'constraint' => 11, 'null' => false, 'default' => 1],
            'precioUnitario'  => ['type' => 'DOUBLE', 'null' => false, 'default' => 0],
            'TotalComprar'    => ['type' => 'DOUBLE', 'null' => false, 'default' => 0],
        ]);
        $this->forge->addKey('idDetallePedido', true);
        $this->forge->addForeignKey('idPedido', 'pedido', 'idPedido', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idProducto', 'producto', 'idProducto', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('detallepedido', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('detallepedido', true);
    }
}
