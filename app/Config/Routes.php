<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'Home::index');
$routes->get('active/(:any)', 'Home::getUserByActive/$1');