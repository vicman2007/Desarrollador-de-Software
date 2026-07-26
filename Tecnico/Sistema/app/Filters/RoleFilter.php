<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * RoleFilter
 *
 * Restringe el acceso a rutas segun el rol del usuario.
 * Se usa pasando los ids de rol permitidos como argumentos, por ejemplo:
 *   ['filter' => 'role:2']       -> solo administrador
 *   ['filter' => 'role:2,3']     -> administrador o domiciliario
 *
 * Roles: 1 = cliente, 2 = administrador, 3 = domiciliario.
 */
class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesion para continuar.');
        }

        $rolActual = (int) $session->get('idRol');

        if (! empty($arguments) && ! in_array((string) $rolActual, $arguments, true)) {
            return redirect()->to('/dashboard')->with('error', 'No tienes permisos para acceder a esa seccion.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se requiere accion posterior.
    }
}
