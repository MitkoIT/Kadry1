<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;
use App\Libraries\EmployeeLibrary;
use App\Libraries\CompanyLibrary;

class EmployeeController extends BaseController
{
    public function employees(): string
    {
        $title = 'Pracownicy';

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/body/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => null,
                    'selected' => null,
                    'employees' => (new EmployeeLibrary())->getEmployees()
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function activeEmployees(): string
    {
        $title = 'Aktywni pracownicy';

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/body/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => null,
                    'selected' => 'aktywni',
                    'employees' => (new EmployeeLibrary())->getEmployees('active')
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function unactiveEmployees(): string
    {
        $title = 'Nieaktywni pracownicy';

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/body/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => null,
                    'selected' => 'nieaktywni',
                    'employees' => (new EmployeeLibrary())->getEmployees('unactive')
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function companyEmployees(int $companyId): string
    {
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Pracownicy '.$company->name;

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'company',
                        'company' => $company
                    ]
                ])
            ]).
            view('base/body/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => $company,
                    'selected' => null,
                    'employees' => (new EmployeeLibrary())->getEmployees(
                        null,
                        $company
                    )
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function companyActiveEmployees(int $companyId): string
    {
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Aktywni pracownicy '.$company->name;

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'company',
                        'company' => $company
                    ]
                ])
            ]).
            view('base/body/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => $company,
                    'selected' => 'aktywni',
                    'employees' => (new EmployeeLibrary())->getEmployees(
                        'active',
                        $company
                    )
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function companyUnactiveEmployees(int $companyId): string
    {
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Nieaktywni pracownicy '.$company->name;

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'company',
                        'company' => $company
                    ]
                ])
            ]).
            view('base/body/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => $company,
                    'selected' => 'nieaktywni',
                    'employees' => (new EmployeeLibrary())->getEmployees(
                        'unactive',
                        $company
                    )
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function redirectToEmployees(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to('/pracownicy');
    }

    public function employee(int $userId): string
    {
        $user = (new UserLibrary())->getUserDetails($userId);
        $title = $user->name;

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'employee',
                        'user' => $user
                    ]
                ])
            ]).
            view('base/body/end')
        ;
    }

    public function employeeLogs(int $userId): string
    {
        $user = (new UserLibrary())->getUserDetails($userId);
        $title = 'Logi - '.$user->name;

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'employee',
                        'user' => $user
                    ]
                ])
            ]).
            view('base/body/end')
        ;
    }

    public function employeeAplications(int $userId): string
    {
        $user = (new UserLibrary())->getUserDetails($userId);
        $title = 'Aplikacje - '.$user->name;

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'employee',
                        'user' => $user
                    ]
                ])
            ]).
            view('base/body/end')
        ;
    }

    public function addEmployee(): string
    {
        $title = 'Nowy pracownik';

        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title,
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('content/form-employee', [
                'title' => $title
            ]).
            view('base/body/end')
        ;
    }

    public function deactivateEmployee(int $userId): \CodeIgniter\HTTP\Response
    {
        return $this->response
            ->setJSON([
                'success' => (new EmployeeLibrary())
                    ->deactivateEmployee($userId)
                ,
            ])
            ->setStatusCode(200)
        ;
    }
}
