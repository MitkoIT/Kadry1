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
    public function jobPositions(): string
    {
        $title = 'Stanowiska';

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
            view('content/diagram-job-positions', [
                'data' => [
                    'nodes' => (new JobPositionLibrary())
                        ->getJobPositionSchema()
                    ,
                ]
            ]).
            view('base/body/end')
        ;
    }

    public function jobPosition(int $jobPositionId): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $companies = (new CompanyLibrary())->getCompanies();

        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();

            if (isset($post['delete'])) {
                (new JobPositionLibrary())->deleteJobPosition($jobPositionId);

                return redirect()->to('/stanowiska');
            } else {
                $jobPositionId = (new JobPositionLibrary())->setJobPosition(
                    $jobPositionId,
                    $post,
                    $companies
                );

                return redirect()->to(base_url('stanowisko/'.$jobPositionId));
            }
        } elseif ($this->request->getMethod() === 'get') {
            $jobPosition = (new JobPositionLibrary())
                ->getJobPositionDetails($jobPositionId)
            ;
            $title = $jobPosition->name;

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
                            'type' => 'jobPosition',
                            'jobPosition' => $jobPosition
                        ]
                    ])
                ]).
                view('base/body/nav-end').
                view('content/form-job-position', [
                    'isNewForm' => false,
                    'data' => [
                        'jobPosition' => (new JobPositionLibrary())
                            ->getJobPositionDetails(
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
                        ]
                    ]
                ]).
                view('base/body/end')
            ;
        }
    }

    public function addJobPosition(int $jobPositionId): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $companies = (new CompanyLibrary())->getCompanies();
        
        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();

            $jobPositionId = (new JobPositionLibrary())->setJobPosition(
                $jobPositionId,
                $post,
                $companies,
                true
            );

            return redirect()->to(base_url('stanowisko/'.$jobPositionId));
        } elseif ($this->request->getMethod() === 'get') {
            $jobPosition = (new JobPositionLibrary())
                ->getJobPositionDetails($jobPositionId)
            ;
            $title = $jobPosition->name;

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
                            'type' => 'jobPosition',
                            'jobPosition' => $jobPosition
                        ]
                    ])
                ]).
                view('base/body/nav-end').
                view('content/form-job-position', [
                    'isNewForm' => true,
                    'data' => [
                        'jobPosition' => null
                    ]
                ]).
                view('base/body/end')
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

    public function redirectToJobPositions(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to('/stanowiska');
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
            ]);
        } elseif ($this->request->getMethod() === 'delete') {
            return $this->response->setJSON([
                'success' => (new JobPositionLibrary())
                    ->deleteJobPositionEmployee(
                        $jobPositionId,
                        $employeeId,
                    )
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
