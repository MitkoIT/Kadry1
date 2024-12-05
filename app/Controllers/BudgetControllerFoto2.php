<?php

namespace App\Controllers;

use App\Models\TestModel;


use App\Libraries\FormatLibrary;
use App\Libraries\BreadcrumbsLibrary;
use App\Libraries\UserLibrary;

class BudgetController extends BaseController
{
    public function budgets(): string
    {
        $a = (new TestModel())->findAll();

        echo '<pre>'.print_r($a, true).'</pre>';die();

        $title = 'Budżet';

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
                'breadcrumbs' => (new BreadcrumbsLibrary())->parse()
            ]).
            view('base/body/nav-end').
            view('base/body/end')
        ;
    }
}
