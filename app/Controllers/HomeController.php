<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('Base/header', [
                    'title' => 'Panel Administracyjny'
                ]).
            view('Panels/side-bar').
            view('Panels/main', [
                'header' => 'Panel Administracyjny'
            ]).
            view('Base/footer');
    }
}