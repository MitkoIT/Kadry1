<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'HomeController::getActiveUsers');
$routes->add('index', 'HomeController::getActiveUsers');
$routes->add('active', 'HomeController::getActiveUsers');
$routes->add('all-users', 'HomeController::getAllUsersWithCompanys');
$routes->add('unactive', 'HomeController::getUnactiveUsers');
$routes->post('search', 'HomeController::getUserByName');
$routes->get('pass-success', 'HomeController::passSetSuccess');

$routes->get('passchng/(:num)', 'UserController::editUserPassword/$1');
$routes->get('setunactive/(:num)', 'UserController::setUserUnactive/$1');
$routes->get('edit/(:num)', 'UserController::editUserDataForEdit/$1');
$routes->post('storeuserdata/(:num)', 'UserController::setUserDataForEdit/$1');
$routes->post('storeusercompany/(:num)', 'UserController::setUserCompanyForEdit/$1');
$routes->post('firstpasswd/(:num)', 'UserController::setUserPassword/$1');
$routes->get('deletecompanyelement/(:num)/(:num)','UserController::deleteUserCompanyElement/$1/$2');
$routes->get('addcompanyelement/(:num)', 'UserController::addUserCompanyElement/$1');

$routes->add('paste', 'UserController::editUserDataForAdd');
$routes->post('add', 'UserController::setUserDataForAdd');
