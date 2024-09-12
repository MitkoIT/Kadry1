<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\UserModel;
use App\Models\UserCompanyModel;


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

    public function setUserUnactive(int $id)
    {
        $data = [
            'active' => 'n'
        ];

        $userModel = new UserModel();

        if ($userModel->update($id, $data)) {
            return redirect()->to('unactive');
        } else {
            return redirect()->to('/');
        }
    }

    public function editUserData(int $id, int $companyId)
    {
        helper(['form']);

        $userModel = new UserModel();
        $companyModel = new CompanyModel();

        $data['user_data'] = $userModel->getUserById($id);
        $data['company_data'] = $companyModel->getCompanyById($companyId);
        $data['company_list'] = $companyModel->getAllCompanies();
        $data['header'] = 'Edytuj Użytkownika';

        return view('Base/header', [
                'title' => 'Edytu Użytkownika'
            ]).
            view('Panels/side-bar').
            view('Panels/main-edit', $data).
            view('Base/footer');
    }

    public function setUserData(int $id)
    {
        helper(['form']);
        $rules = [
            'name'              => 'required|min_length[2]|max_length[128]',
            'email'             => 'required|min_length[4]|max_length[128]|valid_email|',
            'phone'             => 'required|min_length[2]|max_length[20]',
            'firma'             => 'required'
        ]; 
          
        if ($this->validate($rules)) { 
            $userModel = new UserModel();
            $userCompanyModel = new UserCompanyModel();

            $data = [ 
                'name'                  => $this->request->getVar('name'),
                'email'                 => $this->request->getVar('email'),
                'phone_shop_mitko'      => $this->request->getVar('phone'),
            ]; 

            $companyData = [
                'id_user'   => $id,
                'id_company'  => $this->request->getVar('firma')
            ];

            $userModel->update($id, $data);
            $userCompanyModel->update($userCompanyModel->getUserCompanyByData($id, 00), $companyData);

            return redirect()->to('/');

        } else {
            echo 'failed';
        }
    }
}