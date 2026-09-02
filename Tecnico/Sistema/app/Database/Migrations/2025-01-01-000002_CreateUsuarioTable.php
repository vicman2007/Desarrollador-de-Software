<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabla de usuarios de la reposteria.
 * La contrasena se guarda hasheada (password_hash), por eso el campo es VARCHAR(255).
 */
class CreateUsuarioTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idUsuario'        => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'nombre'       => ['type' => 'VARCHAR', 'constraint' => 60, 'null' => false],
            'apellido'     => ['type' => 'VARCHAR', 'constraint' => 60, 'null' => true],
            'correo'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'contrasena'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'idRol'        => ['type' => 'INT', 'constraint' => 11, 'null' => false, 'default' => 1],
            'estado'       => ['type' => 'INT', 'constraint' => 1, 'null' => false, 'default' => 1],
        ]);
        $this->forge->addKey('idUsuario', true);
        $this->forge->addUniqueKey('correoUsuario');
        $this->forge->addForeignKey('idRolFK', 'rol', 'idRol', 'SET NULL', 'CASCADE');
        $this->forge->createTable('usuario', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('usuario', true);
    }
}
