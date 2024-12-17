<?php

namespace App\Controllers;

use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;

class BudgetController extends BaseController
{
    public function budgets(): string
    {
        $title = 'Budżet';

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
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/nav-end').
            view('base/end')
        ;
    }
}
