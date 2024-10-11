<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

 //users
$routes->add('/', 'UserController::getActiveUsers');
$routes->add('index', 'UserController::getActiveUsers');
$routes->add('active', 'UserController::getActiveUsers');
$routes->add('all-users', 'UserController::getAllUsersWithCompanys');
$routes->add('unactive', 'UserController::getUnactiveUsers');
$routes->post('user-search', 'UserController::getUserByName');
$routes->get('pass-success', 'UserController::passSetSuccess');

$routes->get('passchng/(:num)', 'UserController::editUserPassword/$1');
$routes->get('setunactive/(:num)', 'UserController::setUserUnactive/$1');
$routes->post('firstpasswd/(:num)', 'UserController::setUserPassword/$1');

$routes->get('user-edit/(:num)', 'UserController::editUserDataForEdit/$1');
$routes->post('user-edit-save/(:num)', 'UserController::setUserDataForEdit/$1');
$routes->post('user-edit-save-company/(:num)', 'UserController::setUserCompanyForEdit/$1');
$routes->get('user-edit-delete-company/(:num)/(:num)','UserController::deleteUserCompanyElement/$1/$2');
$routes->get('user-edit-add-company/(:num)', 'UserController::addUserCompanyElement/$1');

$routes->add('user-add', 'UserController::editUserDataForAdd');
$routes->post('user-add-save', 'UserController::setUserDataForAdd');

//budget
$routes->add('budget-allbudgets','BudgetController::getBudgets');
$routes->post('budget-search', 'BudgetController::getBudgetByName');
$routes->add('budget-addbudget', 'BudgetConstroller::addBudget');