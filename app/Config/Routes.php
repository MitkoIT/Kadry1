<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('LoginController');
$routes->get('logowanie', 'LoginController::login', ['filter' => 'NoAuth']);
$routes->get('wylogowywanie', 'LoginController::logout', ['filter' => 'UserAuth']);
$routes->get('nie-zalogowany', 'LoginController::noAuth', ['filter' => 'NoAuth']);
$routes->get('/', 'HomeController::home', ['filter' => 'UserAuth']);
$routes->group('pracownicy', ['filter' => 'UserAuth'], function($routes) {
    $routes->get('', 'EmployeeController::employees');
    $routes->get('aktywni', 'EmployeeController::activeEmployees');
    $routes->get('nieaktywni', 'EmployeeController::unactiveEmployees');
    $routes->get('(:num)', 'EmployeeController::companyEmployees/$1');
    $routes->get('(:num)/aktywni', 'EmployeeController::companyActiveEmployees/$1');
    $routes->get('(:num)/nieaktywni', 'EmployeeController::companyUnactiveEmployees/$1');
});
$routes->group('pracownik', ['filter' => 'UserAuth'], function($routes) {
    $routes->get('', 'EmployeeController::redirectToEmployees');
    $routes->match(['get','post'], 'nowy', 'EmployeeController::addEmployee');
    $routes->match(['get','post'], '(:num)', 'EmployeeController::employee/$1');
    $routes->get('(:num)/logi', 'EmployeeController::employeeLogs/$1');
    $routes->get('(:num)/aplikacje', 'EmployeeController::employeeAplications/$1');
    $routes->put('(:num)/zdezaktywuj', 'EmployeeController::deactivateEmployee/$1');
});
$routes->get('stanowiska', 'JobPositionController::jobPositions', ['filter' => 'UserAuth']);
$routes->group('stanowisko', ['filter' => 'UserAuth'], function($routes) {
    $routes->get('', 'JobPositionController::redirectToJobPositions');
    $routes->match(['get','post'], '(:num)', 'JobPositionController::jobPosition/$1', ['filter' => 'UserAuth']);
    $routes->match(['get','post'], '(:num)/nowy', 'JobPositionController::addJobPosition/$1', ['filter' => 'UserAuth']);
});
$routes->get('api/v1/job-position/(:num)', 'JobPositionController::getJobPositionDetails/$1', ['filter' => 'UserAuth']);
//$routes->get('pracownicy', 'EmployeeController::employees', ['filter' => 'UserAuth']);
//$routes->get('pracownicy/aktywni', 'EmployeeController::activeEmployees', ['filter' => 'UserAuth']);
//$routes->get('pracownicy/nieaktywni', 'EmployeeController::unactiveEmployees', ['filter' => 'UserAuth']);
$routes->get('budzet', 'BudgetController::budgets', ['filter' => 'UserAuth']);

$routes->add('index', 'UserController::getActiveUsers2', ['filter' => 'NoAuth']);
$routes->add('active', 'UserController::getActiveUsers2', ['filter' => 'NoAuth']);
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