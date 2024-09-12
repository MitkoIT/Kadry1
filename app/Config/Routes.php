<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'HomeController::index');
$routes->add('index', 'HomeController::index');
$routes->add('active', 'HomeController::getActiveUsers');
$routes->add('unactive', 'HomeController::getUnactiveUsers');
