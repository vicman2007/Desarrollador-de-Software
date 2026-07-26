<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * Controlador base del que heredan todos los controladores de la aplicacion.
 * Centraliza los helpers cargados, la sesion y utilidades comunes de la
 * Reposteria Misves.
 */
abstract class BaseController extends Controller
{
    /**
     * Instancia de la peticion.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helpers que se cargan automaticamente en cada controlador.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url', 'text'];

    /**
     * Sesion de CodeIgniter, disponible para todos los controladores hijos.
     */
    protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
    }

    /**
     * Indica si hay un usuario autenticado en la sesion.
     */
    protected function estaLogueado(): bool
    {
        return (bool) $this->session->get('logueado');
    }

    /**
     * Devuelve el id del rol del usuario en sesion (1 cliente, 2 admin, 3 domiciliario).
     */
    protected function rolActual(): ?int
    {
        $rol = $this->session->get('idRol');

        return $rol === null ? null : (int) $rol;
    }
}
