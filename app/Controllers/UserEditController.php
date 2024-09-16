<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;

class UserEditController extends BaseController
{
   
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

    public function setUserData(int $id, int $idcompany)
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
                'name'                  => $this->request->getPost('name'),
                'email'                 => $this->request->getPost('email'),
                'phone_shop_mitko'      => $this->request->getPost('phone'),
            ]; 

            $companyData = [
                'id_user'   => $id,
                'id_company'  => $this->request->getPost('firma')
            ];

            if ($userModel->update($id, $data)) {

                if ($userCompanyModel->update($userCompanyModel->getUserCompanyByData($id, $idcompany), $companyData)) {
                    
                   // $lastQuery = $userCompanyModel->getLastQuery();
                   // echo $lastQuery; // wyswietl ostatnia kwerende
                   // echo $companyData['id_company'];
                    return redirect()->to('/');
                } else {
                    echo 'failed company update';
                }
            } else {
                echo 'failed...user update';
            }

        } else {
            echo 'failed by validation';
        }
    }
}