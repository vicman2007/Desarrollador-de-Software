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
            'idDetalle'       => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'Cantidad'        => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'default' => 1],
            'PrecioUnitario'  => ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
            'TotalProducto'   => ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
            'SubtotalComprar' => ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
            'TotalComprar'    => ['type' => 'DOUBLE', 'null' => true, 'default' => 0],
            'idCarritoFK'     => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'CodProductoFK'   => ['type' => 'INT', 'constraint' => 11, 'null' => true],
        ]);
        $this->forge->addKey('idDetalle', true);
        $this->forge->addForeignKey('idCarritoFK', 'pedidos', 'idCarrito', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('CodProductoFK', 'producto', 'CodProducto', 'SET NULL', 'CASCADE');
        $this->forge->createTable('detallepedido', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('detallepedido', true);
    }
}
