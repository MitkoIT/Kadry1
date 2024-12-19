<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;
use App\Libraries\EmployeeLibrary;
use App\Libraries\JobPositionLibrary;
use App\Libraries\BudgetLibrary;
use App\Libraries\CompanyLibrary;

class JobPositionController extends BaseController
{
    public function jobPositions(int $companyId): string
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $notifications = (new UserLibrary())
            ->getUserNotifications($user->id)
        ;
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $title = 'Stanowiska '.ucfirst(strtolower($company->name));
        $nodes = (new JobPositionLibrary())
            ->getJobPositionSchema(
                $company
            )
        ;

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
            view('content/diagram-job-positions', [
                'data' => [
                    'nodes' => $nodes,
                    'company' => $company,
                    'employees' => (new EmployeeLibrary())
                        ->getEmployees(null, $company)
                    ,
                    'unassignedBudgets' => (new JobPositionLibrary())
                        ->getUnassignedBudgets(
                            (new BudgetLibrary())->getBudgets()
                        )
                    ,
                ]
            ]).
            view('base/end')
        ;
    }

    public function jobPosition(
        int $companyId,
        int $jobPositionId
    ): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $companies = (new CompanyLibrary())->getCompanies();
        $budgets = (new BudgetLibrary())->getBudgets();

        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();

            $jobPositionId = (new JobPositionLibrary())->setJobPosition(
                $companyId,
                $jobPositionId,
                $post,
                $companies
            );

            if (is_numeric($jobPositionId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'save-success'
                );
            }

            return redirect()->to(base_url('stanowisko/'.$companyId.'/'.$jobPositionId));
        } elseif ($this->request->getMethod() === 'get') {
            $notifications = (new UserLibrary())
                ->getUserNotifications($user->id)
            ;
            $jobPosition = (new JobPositionLibrary())
                ->getJobPositionDetails($jobPositionId)
            ;
            $title = 'Stanowisko '.$jobPosition->name;

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
                        ],
                        2 => [
                            'type' => 'jobPosition',
                            'jobPosition' => $jobPosition
                        ]
                    ])
                ]).
                view('base/notification', [
                    'data' => [
                        'notifications' => $notifications
                    ]
                ]).
                view('base/nav-end').
                view('content/form-job-position', [
                    'isNewForm' => false,
                    'data' => [
                        'company' => $company,
                        'budgets' => $budgets,
                        'jobPosition' => [
                            'details' => (new JobPositionLibrary())
                                ->getJobPositionDetails(
                                    $jobPositionId
                                ),
                            'users' => (new JobPositionLibrary())
                                ->getJobPositionUsersDetails(
                                    $jobPositionId
                                )
                            ,
                            'employees' => [
                                'position' => (new EmployeeLibrary())
                                    ->getJobPositionEmployees(
                                        $jobPositionId
                                    )
                                ,
                                'all' => (new EmployeeLibrary())
                                    ->getEmployees()
                                ,
                            ],
                            'budgets' => (new JobPositionLibrary())
                                ->getJobPositionBudgets(
                                    $jobPositionId
                                )
                            ,
                        ],
                    ]
                ]).
                view('base/end')
            ;
        }
    }

    public function addJobPosition(
        int $companyId,
        int $jobPositionId
    ): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $companies = (new CompanyLibrary())->getCompanies();
        
        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();

            $jobPositionId = (new JobPositionLibrary())->setJobPosition(
                $companyId,
                $jobPositionId,
                $post,
                $companies,
                true
            );

            if (is_numeric($jobPositionId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'added-job-position'
                );
            }

            return redirect()->to(base_url('stanowisko/'.$companyId.'/'.$jobPositionId));
        } elseif ($this->request->getMethod() === 'get') {
            $jobPosition = (new JobPositionLibrary())
                ->getJobPositionDetails($jobPositionId)
            ;
            $title = $jobPosition->name;

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
                        ],
                        2 => [
                            'type' => 'jobPosition',
                            'jobPosition' => $jobPosition
                        ]
                    ])
                ]).
                view('base/nav-end').
                view('content/form-job-position', [
                    'isNewForm' => true,
                    'data' => [
                        'jobPosition' => null
                    ]
                ]).
                view('base/end')
            ;
        }
    }

    public function getJobPositionDetails(int $jobPositionId): \CodeIgniter\HTTP\Response
    {
        return $this->response->setJSON([
            'data' => (new JobPositionLibrary())
                ->getJobPositionDetails(
                    $jobPositionId
                )
            ,
        ]);
    }

    public function redirectToHome(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to('/');
    }

    public function editJobPositionEmployees(
        int $jobPositionId,
        int $employeeId
    ): \CodeIgniter\HTTP\Response
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);

        if ($this->request->getMethod() === 'post') {
            if (is_numeric($jobPositionId) && is_numeric($employeeId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'added-employee-to-job-position'
                );
            }

            return $this->response->setJSON([
                'success' => (new JobPositionLibrary())
                    ->addJobPositionEmployee(
                        $jobPositionId,
                        $employeeId,
                    )
                ,
            ]);
        } elseif ($this->request->getMethod() === 'put') {
            $request = \Config\Services::request();

            if (is_numeric($jobPositionId) && is_numeric($employeeId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'changed-employee-job-position-description'
                );
            }

            return $this->response->setJSON([
                'success' => (new JobPositionLibrary())
                    ->updateJobPositionEmployeeDescription(
                        $jobPositionId,
                        $employeeId,
                        $request->getRawInput()['description']
                    )
                ,
            ]);
        } elseif ($this->request->getMethod() === 'delete') {
            if (is_numeric($jobPositionId) && is_numeric($employeeId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'deleted-employee-from-job-position'
                );
            }

            return $this->response->setJSON([
                'success' => (new JobPositionLibrary())
                    ->deleteJobPositionEmployee(
                        $jobPositionId,
                        $employeeId,
                    )
                ,
            ]);
        }
    }

    public function editJobPositionBudgets(
        int $jobPositionId,
        int $budgetId
    ): \CodeIgniter\HTTP\Response
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);

        if ($this->request->getMethod() === 'post') {
            if (is_numeric($jobPositionId) && is_numeric($budgetId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'added-budget-to-job-position'
                );
            }

            return $this->response->setJSON([
                'success' => (new JobPositionLibrary())
                    ->addJobPositionBudget(
                        $jobPositionId,
                        $budgetId,
                    )
                ,
            ]);
        } elseif ($this->request->getMethod() === 'delete') {
            if (is_numeric($jobPositionId) && is_numeric($budgetId)) {
                (new UserLibrary())->setUserNotification(
                    $user->id,
                    'deleted-budget-from-job-position'
                );
            }

            return $this->response->setJSON([
                'success' => (new JobPositionLibrary())
                    ->deleteJobPositionBudget(
                        $jobPositionId,
                        $budgetId,
                    )
                ,
            ]);
        }
    }

    public function deleteJobPosition(int $jobPositionId): \CodeIgniter\HTTP\Response
    {
        $user = (new UserLibrary())->getSessionDetails($_SESSION);
        
        (new JobPositionLibrary())
            ->deleteJobPosition($jobPositionId)
        ;

        if (is_numeric($jobPositionId)) {
            (new UserLibrary())->setUserNotification(
                $user->id,
                'deleted-job-position'
            );
        }

        return $this->response->setJSON([
            'success' => true
        ]);
    }
}
