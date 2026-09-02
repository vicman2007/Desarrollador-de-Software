<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Usuarios de ejemplo. Las contrasenas se guardan hasheadas.
 *
 * Credenciales de acceso (correo / contrasena en texto plano):
 *   admin@misves.com        / admin123      (administrador)
 *   cliente@misves.com      / cliente123    (cliente)
 *   domicilio@misves.com    / domicilio123  (domiciliario)
 */
class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuarios = [
            [
                'nombreUsuario'    => 'Administrador Misves',
                'tipodocumento'    => 'CC',
                'NoDoc'            => 1133256845,
                'correoUsuario'    => 'admin@misves.com',
                'direccionUsuario' => 'Calle 4C #45-78',
                'telefonoUsuario'  => 3224183583,
                'estadoUsuario'    => 'Activo',
                'contrasena'       => password_hash('admin123', PASSWORD_DEFAULT),
                'idRolFK'          => 2,
            ],
            [
                'nombreUsuario'    => 'Esteban Castro',
                'tipodocumento'    => 'CC',
                'NoDoc'            => 41698527,
                'correoUsuario'    => 'cliente@misves.com',
                'direccionUsuario' => 'Kra 11 #9-56',
                'telefonoUsuario'  => 3214331617,
                'estadoUsuario'    => 'Activo',
                'contrasena'       => password_hash('cliente123', PASSWORD_DEFAULT),
                'idRolFK'          => 1,
            ],
            [
                'nombreUsuario'    => 'Angel Feliciano',
                'tipodocumento'    => 'CC',
                'NoDoc'            => 417896556,
                'correoUsuario'    => 'domicilio@misves.com',
                'direccionUsuario' => 'Cll 21 #95-52',
                'telefonoUsuario'  => 3213462026,
                'estadoUsuario'    => 'Activo',
                'contrasena'       => password_hash('domicilio123', PASSWORD_DEFAULT),
                'idRolFK'          => 3,
            ],
            [
                'nombreUsuario'    => 'Jose Pardo',
                'tipodocumento'    => 'CC',
                'NoDoc'            => 53689745,
                'correoUsuario'    => 'josep@misves.com',
                'direccionUsuario' => 'Calle 9 #20-78',
                'telefonoUsuario'  => 322789845,
                'estadoUsuario'    => 'Activo',
                'contrasena'       => password_hash('jose123', PASSWORD_DEFAULT),
                'idRolFK'          => 1,
            ],
            [
                'nombreUsuario'    => 'Kevin Nino',
                'tipodocumento'    => 'TI',
                'NoDoc'            => 1028664969,
                'correoUsuario'    => 'kevin@misves.com',
                'direccionUsuario' => 'Calle 10 #20-78',
                'telefonoUsuario'  => 3223973202,
                'estadoUsuario'    => 'Activo',
                'contrasena'       => password_hash('kevin123', PASSWORD_DEFAULT),
                'idRolFK'          => 3,
            ],
        ];

        $this->db->table('usuario')->insertBatch($usuarios);
    }
}
