<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;
use App\Libraries\EmployeeLibrary;
use App\Libraries\JobPositionLibrary;
use App\Libraries\CompanyLibrary;

class EmployeeController extends BaseController
{
    public function employees(): string
    {
        $title = 'Pracownicy';

        return
            view('base/nav-begin', [
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
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => null,
                    'selected' => null,
                    'employees' => (new EmployeeLibrary())
                        ->getEmployees()
                    ,
                ]
            ]).
            view('base/end')
        ;
    }

    public function activeEmployees(): string
    {
        $title = 'Aktywni pracownicy';

        return
            view('base/nav-begin', [
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
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => null,
                    'selected' => 'aktywni',
                    'employees' => (new EmployeeLibrary())->getEmployees('active')
                ]
            ]).
            view('base/end')
        ;
    }

    public function unactiveEmployees(): string
    {
        $title = 'Nieaktywni pracownicy';

        return
            view('base/nav-begin', [
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
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/nav-end').
            view('content/table-employees', [
                'data' => [
                    'title' => $title,
                    'company' => null,
                    'selected' => 'nieaktywni',
                    'employees' => (new EmployeeLibrary())->getEmployees('unactive')
                ]
            ]).
            view('base/end')
        ;
    }

    public function companyEmployees(int $companyId): string
    {
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Pracownicy '.ucfirst(strtolower($company->name));

        return
            view('base/nav-begin', [
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
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'company',
                        'company' => $company
                    ]
                ])
            ]).
            view('base/nav-end').
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
            view('base/end')
        ;
    }

    public function companyActiveEmployees(int $companyId): string
    {
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Aktywni pracownicy '.ucfirst(strtolower($company->name));

        return
            view('base/nav-begin', [
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
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'company',
                        'company' => $company
                    ]
                ])
            ]).
            view('base/nav-end').
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
            view('base/end')
        ;
    }

    public function companyUnactiveEmployees(int $companyId): string
    {
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Nieaktywni pracownicy '.ucfirst(strtolower($company->name));

        return
            view('base/nav-begin', [
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
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'company',
                        'company' => $company
                    ]
                ])
            ]).
            view('base/nav-end').
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
            view('base/end')
        ;
    }

    public function redirectToEmployees(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to('/pracownicy');
    }

    public function employee(int $userId = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $companies = (new CompanyLibrary())->getCompanies();

        if ($this->request->getMethod() === 'post') {
            $employeeId = (new EmployeeLibrary())->setEmployee(
                $userId,
                $this->request->getPost(),
                $companies
            );

            return redirect()->to(base_url('pracownik/'.$employeeId));
        } elseif ($this->request->getMethod() === 'get') {
            $user = (new UserLibrary())->getUserDetails($userId);
            $title = $user->name;

            return
                view('base/nav-begin', [
                    'user' => (new UserLibrary())->getSessionDetails(
                        $_SESSION
                    ),
                    'page' => (new FormatLibrary())->toObject([
                        'title' => $title,
                        'companies' => $companies
                    ])
                ]).
                view('base/breadcrumb', [
                    'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                        1 => [
                            'type' => 'employee',
                            'user' => $user
                        ]
                    ])
                ]).
                view('content/form-employee', [
                    'data' => [
                        'title' => $title,
                        'companies' => $companies,
                        'employee' => (new EmployeeLibrary())
                            ->getEmployeeDetails(
                                $user,
                                $companies
                            )
                        ,
                    ]
                ]).
                view('base/end')
            ;
        }
    }

    public function employeeLogs(int $userId): string
    {
        $user = (new UserLibrary())->getUserDetails($userId);
        $title = 'Logi - '.$user->name;

        return
            view('base/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title
                ])
            ]).
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'employee',
                        'user' => $user
                    ]
                ])
            ]).
            view('base/end')
        ;
    }

    public function employeeAplications(int $userId): string
    {
        $user = (new UserLibrary())->getUserDetails($userId);
        $title = 'Aplikacje - '.$user->name;

        return
            view('base/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => $title
                ])
            ]).
            view('base/breadcrumb', [
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse([
                    1 => [
                        'type' => 'employee',
                        'user' => $user
                    ]
                ])
            ]).
            view('base/end')
        ;
    }

    public function addEmployee(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $companies = (new CompanyLibrary())->getCompanies();

        if ($this->request->getMethod() === 'post') {
            $employeeId = (new EmployeeLibrary())->setEmployee(
                null,
                $this->request->getPost(),
                $companies
            );

            return redirect()->to(base_url('pracownik/'.$employeeId));
        } elseif ($this->request->getMethod() === 'get') {
            $title = 'Nowy pracownik';

            return
                view('base/nav-begin', [
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
                view('base/breadcrumb', [
                    'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
                ]).
                view('content/form-employee', [
                    'data' => [
                        'title' => $title,
                        'companies' => $companies
                    ]
                ]).
                view('base/end')
            ;
        }
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
