<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\UserModel;
use App\Models\UserCompanyModel;


class HomeController extends BaseController
{
    public function getAllUsersWithCompanys(): string
    {
        helper(['form']);

        $userModel = new UserModel();
        $perPage = 100;
        //jezeli nic tu nie ma to wstaw 1 strone
        $page = $this->request->getVar('page') ?: 1;

        $data = [
            'user_data' => $userModel
                ->getPaginatedAllUsersWithCompanys(
                    $perPage, $page
                ),
            'pager'     => $userModel->pager,
            'header'    => 'Wszyscy Użytkownicy'
        ];

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            //view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getAllUsers()
    {
        helper(['form']);

        $userModel = new UserModel();
        $companyModel = new UserCompanyModel();
        $perPage = 100;
        //jezeli nic tu nie ma to wstaw 1 strone
        $page = $this->request->getVar('page') ?: 1;

        $users_data =  $userModel
            ->getPaginatedAllUsers(
            $perPage, $page
        );


        $user_company = array(array(), array());

        foreach ($users_data as $user) {
            $user_company['user'] = $user;
            $user_company['company'] = $companyModel->getUserCompanyByUserId($user['idusers']);
        }

        $data = [
            'user_data' => $user_company,
            'pager'     => $userModel->pager,
            'header'    => 'Wszyscy Użytkownicy'
        ];

        
        echo var_dump($data['user_data']);
    }

    public function passSetSuccess()
    {
        $data = [
            'header' => ''
        ];

        return view('Base/header', [
            'title' => 'Password Successfull'
        ]).
        view('Base/pass-success', $data).
        view('Base/footer'); 
    }

    public function getActiveUsers(): string
    {
        helper(['form']);
        $userModel = new UserModel();
        $perPage = 100;
        $page = $this->request->getVar('page') ?: 1;
       
        $data = [
            'user_data' => $userModel
                ->getPaginatedANUsersWithCompanys(
                    $perPage, $page, 'y'
                ),
            'pager'     => $userModel->pager,
            'header'    => 'Aktywni Użytkownicy'
        ];

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
           // view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getUnactiveUsers(): string
    {
        helper(['form']);
        $userModel = new UserModel();
        $perPage = 100;
        $page = $this->request->getVar('page') ?: 1;

        $data = [
            'user_data' => $userModel
                ->getPaginatedANUsersWithCompanys(
                    $perPage, $page, 'n'
                ),
            'pager'     => $userModel->pager,
            'header'    => 'Nieaktywni Użytkownicy'
        ];

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
           // view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getUserByName()
    {

        helper(['form']);
        $rules = [
            'name'  => 'required|min_length[2]|max_length[128]'
        ]; 

        if ($this->validate($rules)) { 
            $userModel = new UserModel();
            $perPage = 100;
            $page = $this->request->getVar('page') ?: 1;
            $data['user_data'] = $userModel
                ->getUsersByFirstLetterWithCompanys(
                $this->request->getVar('name'),
                $perPage,
                $page
            );
            $data['pager'] = $userModel->pager;
            $data['header'] = 'Wyniki Wyszukiwania';

            return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
           // view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');            

        } else {
            return redirect()->to('/');
        }
    }
}
