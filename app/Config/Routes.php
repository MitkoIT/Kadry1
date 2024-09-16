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

$routes->get('passchng/(:num)', 'UserEditController::editUserPassword/$1');
$routes->get('setunactive/(:num)', 'UserEditController::setUserUnactive/$1');
$routes->get('edit/(:num)/(:num)', 'UserEditController::editUserData/$1/$2');
$routes->post('store/(:num)/(:num)', 'UserEditController::setUserData/$1/$2');
$routes->post('firstpasswd/(:num)', 'UserEditController::setUserPassword/$1');

$routes->add('paste', 'UserAddController::editUserData');
$routes->post('add', 'UserAddController::setUserData');
