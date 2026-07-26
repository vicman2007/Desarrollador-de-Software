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
            'nombreUsuario'    => ['type' => 'VARCHAR', 'constraint' => 60, 'null' => true],
            'tipodocumento'    => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'NoDoc'            => ['type' => 'BIGINT', 'constraint' => 20, 'null' => false, 'default' => 0],
            'correoUsuario'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'direccionUsuario' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'telefonoUsuario'  => ['type' => 'BIGINT', 'constraint' => 20, 'null' => true],
            'estadoUsuario'    => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'default' => 'Activo'],
            'contrasena'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'idRolFK'          => ['type' => 'INT', 'constraint' => 11, 'null' => true],
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
