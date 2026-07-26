<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabla de roles del sistema.
 * 1 = cliente, 2 = administrador, 3 = domiciliario.
 */
class CreateRolTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idRol'          => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'DescripcionRol' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
        ]);
        $this->forge->addKey('idRol', true);
        $this->forge->createTable('rol', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('rol', true);
    }
}
