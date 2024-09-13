<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'HomeController::index');
$routes->add('index', 'HomeController::index');
$routes->add('active', 'HomeController::getActiveUsers');
$routes->add('unactive', 'HomeController::getUnactiveUsers');
$routes->get('setunactive/(:any)', 'HomeController::SetUserUnactive/$1');
$routes->get('edit/(:any)/(:any)', 'HomeController::editUserData/$1/$2');
$routes->post('store/(:any)/(:any)', 'HomeController::setUserData/$1/$2');