<?php

namespace App\Controllers;

class UserEditorController extends BaseController
{
    public function index(): string
    {
        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main-edit', [
                'header' => 'Edytuj Dane Użytkownika'
            ]).
            view('Base/footer');
    }
}