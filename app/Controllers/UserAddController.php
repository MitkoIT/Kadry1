<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;

class UserAddController extends BaseController
{
    public function editUserData(int $companyId)
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
                'name'                  => $this->request->getVar('name'),
                'email'                 => $this->request->getVar('email'),
                'phone_shop_mitko'      => $this->request->getVar('phone'),
            ]; 

            $companyData = [
                'id_user'   => $id,
                'id_company'  => $this->request->getVar('firma')
            ];

            if ($userModel->update($id, $data)) {

                if ($userCompanyModel->update($userCompanyModel->getUserCompanyByData($id, $idcompany), $companyData)) {
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