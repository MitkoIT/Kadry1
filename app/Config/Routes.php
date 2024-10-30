<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

 //users
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
//$routes->get('/', 'LoginController::index', ['filter' => 'NoAuth']);
//$routes->get('logout', 'LoginController::logout', ['filter' => 'NoAuth']);

$routes->add('index', 'UserController::getActiveUsers');
$routes->add('active', 'UserController::getActiveUsers', ['filter' => 'NoAuth']);
$routes->add('all-users', 'UserController::getAllUsersWithCompanys', ['filter' => 'NoAuth']);
$routes->add('unactive', 'UserController::getUnactiveUsers', ['filter' => 'NoAuth']);
$routes->post('user-search', 'UserController::getUserByName', ['filter' => 'NoAuth']);
$routes->get('pass-success', 'UserController::passSetSuccess');

$routes->get('passchng/(:num)', 'UserController::editUserPassword/$1');
$routes->get('setunactive/(:num)', 'UserController::setUserUnactive/$1', ['filter' => 'NoAuth']);
$routes->post('firstpasswd/(:num)', 'UserController::setUserPassword/$1', ['filter' => 'NoAuth']);

$routes->get('user-edit/(:num)', 'UserController::editUserDataForEdit/$1', ['filter' => 'NoAuth']);
$routes->post('user-edit-save/(:num)', 'UserController::setUserDataForEdit/$1', ['filter' => 'NoAuth']);
$routes->post('user-edit-save-company/(:num)', 'UserController::setUserCompanyForEdit/$1', ['filter' => 'NoAuth']);
$routes->post('user-edit-save-note/(:num)', 'UserController::updateUserNote/$1', ['filter' => 'NoAuth']);
$routes->get('user-edit-delete-company/(:num)/(:num)','UserController::deleteUserCompanyElement/$1/$2', ['filter' => 'NoAuth']);
$routes->get('user-edit-add-company/(:num)', 'UserController::addUserCompanyElement/$1', ['filter' => 'NoAuth']);

$routes->add('user-add', 'UserController::editUserDataForAdd', ['filter' => 'NoAuth']);
$routes->post('user-add-save', 'UserController::setUserDataForAdd', ['filter' => 'NoAuth']);

/*budget
$routes->add('budget-allbudgets','BudgetController::getBudgets', ['filter' => 'NoAuth']);
$routes->post('budget-search', 'BudgetController::getBudgetByName', ['filter' => 'NoAuth']);

$routes->get('budget-edit/(:num)', 'BudgetController::editBudgetDataForEdit/$1', ['filter' => 'NoAuth']);
$routes->add('budget-add', 'BudgetController::editBudgetDataForAdd');
$routes->add('budget-add-save', 'BudgetController::setBudgetDataForAdd', ['filter' => 'NoAuth']);*/