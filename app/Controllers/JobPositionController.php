<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;
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
            view('content/job-position-tree2', [
                'data' => [
                    'nodes' => (new JobPositionLibrary())
                        ->getJobPositionSchema()
                    ,
                ]
            ]).
            view('base/body/end')
        ;
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
}
