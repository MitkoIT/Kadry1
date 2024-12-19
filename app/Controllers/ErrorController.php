<?php

namespace App\Controllers;

class ErrorController extends BaseController
{
    public function error500(): string
    {
        return view('errors/html/production');
    }
}
