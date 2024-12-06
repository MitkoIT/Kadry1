<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\UserLibrary;
use App\Libraries\CompanyLibrary;

class HomeController extends BaseController
{
    public function home(): string
    {
        return
            view('base/body/nav-begin', [
                'user' => (new UserLibrary())->getSessionDetails(
                    $_SESSION
                ),
                'page' => (new FormatLibrary())->toObject([
                    'title' => 'Strona główna',
                    'companies' => (new CompanyLibrary())
                        ->getCompanies()
                    ,
                ])
            ]).
            view('base/body/nav-end').
            view('base/body/end')
        ;
    }
}
