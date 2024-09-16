<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'HomeController::index');
$routes->add('index', 'HomeController::index');
$routes->add('active', 'HomeController::getActiveUsers');
$routes->add('unactive', 'HomeController::getUnactiveUsers');
$routes->post('search', 'HomeController::getUserByName');

$routes->get('passchng/(:any)', 'UserEditController::editUserPassword/$1');
$routes->get('setunactive/(:any)', 'UserEditController::setUserUnactive/$1');
$routes->get('edit/(:any)/(:any)', 'UserEditController::editUserData/$1/$2');
$routes->post('store/(:any)/(:any)', 'UserEditController::setUserData/$1/$2');
$routes->post('firstpasswd/(:any)', 'UserEditController::setUserPassword/$1');

$routes->add('paste', 'UserAddController::editUserData');
$routes->post('add', 'UserAddController::setUserData');
