<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('LoginController');
$routes->set404Override(function() {
    return view('base/error404.php');
});
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
$routes->group('stanowiska', ['filter' => 'UserAuth'], function($routes) {
    $routes->get('', 'JobPositionController::redirectToHome', ['filter' => 'UserAuth']);
    $routes->get('(:num)', 'JobPositionController::jobPositions/$1', ['filter' => 'UserAuth']);
});
$routes->group('stanowisko', ['filter' => 'UserAuth'], function($routes) {
    $routes->get(
        '',
        'JobPositionController::redirectToHome'
    );
    $routes->match(
        ['get','post'],
        '(:num)/(:num)',
        'JobPositionController::jobPosition/$1/$2',
        ['filter' => 'UserAuth']
    );
    $routes->match(
        ['get','post'],
        '(:num)/(:num)/nowy',
        'JobPositionController::addJobPosition/$1/$2',
        ['filter' => 'UserAuth']
    );
});
$routes->group('api/v1/job-position', ['filter' => 'UserAuth'], function($routes) {
    $routes->get(
        '(:num)',
        'JobPositionController::getJobPositionDetails/$1',
        ['filter' => 'UserAuth']
    );
    $routes->match(
        ['delete'],
        '(:num)',
        'JobPositionController::deleteJobPosition/$1',
        ['filter' => 'UserAuth']
    );
    $routes->match(
        ['post','put','delete'],
        '(:num)/employees/(:num)',
        'JobPositionController::editJobPositionEmployees/$1/$2',
        ['filter' => 'UserAuth']
    );
    $routes->match(
        ['post','delete'],
        '(:num)/budgets/(:num)',
        'JobPositionController::editJobPositionBudgets/$1/$2',
        ['filter' => 'UserAuth']
    );
});