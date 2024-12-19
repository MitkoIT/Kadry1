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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
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
            view('base/notification', [
                'data' => [
                    'notifications' => $notifications
                ]
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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
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
            view('base/notification', [
                'data' => [
                    'notifications' => $notifications
                ]
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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
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
            view('base/notification', [
                'data' => [
                    'notifications' => $notifications
                ]
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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
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
            view('base/notification', [
                'data' => [
                    'notifications' => $notifications
                ]
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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
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
            view('base/notification', [
                'data' => [
                    'notifications' => $notifications
                ]
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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
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
            view('base/notification', [
                'data' => [
                    'notifications' => $notifications
                ]
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

    public function employee(int $employeeId = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $companies = (new CompanyLibrary())->getCompanies();

        if ($this->request->getMethod() === 'post') {
            $employeeId = (new EmployeeLibrary())->setEmployee(
                $employeeId,
                $this->request->getPost(),
                $companies
            );

            if (is_numeric($employeeId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'save-success'
                );
            }

            return redirect()->to(base_url('pracownik/'.$employeeId));
        } elseif ($this->request->getMethod() === 'get') {
            $notifications = (new UserLibrary())
                ->getUserNotifications($user->id)
            ;
            $user = (new UserLibrary())->getUserDetails($employeeId);
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
                view('base/notification', [
                    'data' => [
                        'notifications' => $notifications
                    ]
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
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $companies = (new CompanyLibrary())->getCompanies();

        if ($this->request->getMethod() === 'post') {
            $employeeId = (new EmployeeLibrary())->setEmployee(
                null,
                $this->request->getPost(),
                $companies
            );

            if (is_numeric($employeeId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'added-employee'
                );
            }

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

    public function deactivateEmployee(int $employeeId): \CodeIgniter\HTTP\Response
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);

        if (is_numeric($employeeId)) {
            (new UserLibrary())->setUserNotification(
                $user->id,
                'deactivated-employee'
            );
        }

        return $this->response
            ->setJSON([
                'success' => (new EmployeeLibrary())
                    ->deactivateEmployee($employeeId)
                ,
                'notifications' => (new UserLibrary())
                    ->getUserNotifications($user->id)
                ,
            ])
            ->setStatusCode(200)
        ;
    }
}
