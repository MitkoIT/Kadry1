<?php

namespace App\Controllers;

use App\Models\UserModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getVar('page') ?: 1;
        $data['user_data'] = $userModel->getPaginatedAllUsers($perPage, $page);
        $data['pager'] = $userModel->pager;
        $data['header'] = 'Panel Administracyjny';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getActiveUsers(): string
    {
        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getVar('page') ?: 1;
        $data['user_data'] = $userModel->getPaginatedANUsers($perPage, $page, 'y');
        $data['pager'] = $userModel->pager;
        $data['header'] = 'Panel Administracyjny';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getUnactiveUsers(): string
    {
        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getVar('page') ?: 1;
        $data['user_data'] = $userModel->getPaginatedANUsers($perPage, $page, 'n');
        $data['pager'] = $userModel->pager;
        $data['header'] = 'Panel Administracyjny';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }
}