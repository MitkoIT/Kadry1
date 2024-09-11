<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'HomeController::index');
$routes->get('active/(:any)', 'ActiveUserController::getUserByActive/$1');