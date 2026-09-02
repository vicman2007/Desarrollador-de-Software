<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 *
 * Rutas de la Reposteria Misves.
 * Roles: 1 = cliente, 2 = administrador, 3 = domiciliario.
 */

// ---------------------------------------------------------------------
// Publicas
// ---------------------------------------------------------------------
$routes->get('/', 'Home::index');
$routes->get('acerca', 'Home::acerca');
$routes->get('contacto', 'Home::contacto');
$routes->get('mision-vision', 'Home::misionVision');
$routes->get('catalogo', 'Home::catalogo');

// ---------------------------------------------------------------------
// Autenticacion
// ---------------------------------------------------------------------
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::procesarLogin');
$routes->get('registro', 'Auth::registro');
$routes->post('registro', 'Auth::procesarRegistro');
$routes->get('logout', 'Auth::logout');

// ---------------------------------------------------------------------
// Zona privada (requiere sesion)
// ---------------------------------------------------------------------
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Perfil: cualquier usuario autenticado
$routes->group('perfil', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Perfil::index');
    $routes->post('actualizar', 'Perfil::actualizar');
    $routes->post('password', 'Perfil::cambiarPassword');
});

// ---------------------------------------------------------------------
// Modulos de administrador (rol 2)
// ---------------------------------------------------------------------
$routes->group('admin', ['filter' => 'role:2'], static function ($routes) {

    // Usuarios
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('usuarios/crear', 'Usuarios::crear');
    $routes->post('usuarios/guardar', 'Usuarios::guardar');
    $routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
    $routes->post('usuarios/actualizar/(:num)', 'Usuarios::actualizar/$1');
    $routes->get('usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1');

    // Productos
    $routes->get('productos', 'Productos::index');
    $routes->get('productos/crear', 'Productos::crear');
    $routes->post('productos/guardar', 'Productos::guardar');
    $routes->get('productos/editar/(:num)', 'Productos::editar/$1');
    $routes->post('productos/actualizar/(:num)', 'Productos::actualizar/$1');
    $routes->get('productos/eliminar/(:num)', 'Productos::eliminar/$1');

    // Resenas
    $routes->get('resenas', 'Resenas::index');
    $routes->get('resenas/crear', 'Resenas::crear');
    $routes->post('resenas/guardar', 'Resenas::guardar');
    $routes->get('resenas/editar/(:num)', 'Resenas::editar/$1');
    $routes->post('resenas/actualizar/(:num)', 'Resenas::actualizar/$1');
    $routes->get('resenas/eliminar/(:num)', 'Resenas::eliminar/$1');

    // Pedidos
    $routes->get('pedidos', 'Pedidos::index');
    $routes->get('pedidos/crear', 'Pedidos::crear');
    $routes->post('pedidos/guardar', 'Pedidos::guardar');
    $routes->get('pedidos/editar/(:num)', 'Pedidos::editar/$1');
    $routes->post('pedidos/actualizar/(:num)', 'Pedidos::actualizar/$1');
    $routes->get('pedidos/eliminar/(:num)', 'Pedidos::eliminar/$1');

    // Estadisticas y analitica
    $routes->get('estadisticas', 'Estadisticas::index');
    $routes->get('mas-vendidos', 'MasVendidos::index');
});

// ---------------------------------------------------------------------
// Modulo de domicilios (administrador rol 2 y domiciliario rol 3)
// ---------------------------------------------------------------------
$routes->group('domicilios', ['filter' => 'role:2,3'], static function ($routes) {
    $routes->get('/', 'Domicilios::index');
    $routes->get('estado/(:any)', 'Domicilios::filtrar/$1');
    $routes->post('actualizar-estado', 'Domicilios::actualizarEstado');
});
