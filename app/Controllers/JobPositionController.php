<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;
use App\Libraries\EmployeeLibrary;
use App\Libraries\JobPositionLibrary;
use App\Libraries\CompanyLibrary;

class JobPositionController extends BaseController
{
    public function jobPositions(int $companyId): string
    {
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
            view('base/nav-end').
            view('content/diagram-job-positions', [
                'data' => [
                    'nodes' => $nodes,
                    'company' => $company,
                    'employees' => (new EmployeeLibrary())
                        ->getEmployees(null, $company)
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
        $company = (new CompanyLibrary())->getCompanyDetails($companyId);
        $companies = (new CompanyLibrary())->getCompanies();

        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();

            $jobPositionId = (new JobPositionLibrary())->setJobPosition(
                $companyId,
                $jobPositionId,
                $post,
                $companies
            );

            return redirect()->to(base_url('stanowisko/'.$companyId.'/'.$jobPositionId));
        } elseif ($this->request->getMethod() === 'get') {
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
                view('base/nav-end').
                view('content/form-job-position', [
                    'isNewForm' => false,
                    'data' => [
                        'company' => $company,
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
                        ],
                        'employees' => [
                            'position' => (new EmployeeLibrary())
                                ->getJobPositionEmployees(
                                    $jobPositionId
                                )
                            ,
                            'all' => (new EmployeeLibrary())
                                ->getEmployees()
                            ,
                        ]
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
        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();

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

    public function deleteJobPosition(int $jobPositionId): \CodeIgniter\HTTP\Response
    {
        return $this->response->setJSON([
            'data' => (new JobPositionLibrary())
                ->deleteJobPosition(
                    $jobPositionId
                )
            ,
        ]);
    }
}
