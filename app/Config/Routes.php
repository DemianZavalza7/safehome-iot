<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Dashboard::index');

$routes->get('api/insertar', 'ApiController::insertar');

$routes->get('api/recientes', 'ApiController::recientes');

$routes->get('api/enviar-correo', 'CorreoController::enviar');
