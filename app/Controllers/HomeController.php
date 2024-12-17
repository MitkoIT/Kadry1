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
            view('base/nav-begin', [
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
            view('base/nav-end').
            view('base/end')
        ;
    }
}
