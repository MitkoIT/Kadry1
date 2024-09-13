<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;

class UserAddController extends BaseController
{
    public function editUserData()
    {
        helper(['form']);

        $companyModel = new CompanyModel();

        $data['company_list'] = $companyModel->getAllCompanies();
        $data['header'] = 'Dodaj Użytkownika';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main-add', $data).
            view('Base/footer');
    }

    public function setUserData()
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
                'idusers'               => $userModel->getNextId(),
                'name'                  => $this->request->getVar('name'),
                'email'                 => $this->request->getVar('email'),
                'phone_shop_mitko'      => $this->request->getVar('phone'),
                'active'                => 'n'
            ]; 

            $companyData = [
                'id_user'       => $data['idusers'],
                'id_company'    => $this->request->getVar('firma')
            ];

            //Your $success is returning the result not false.
            //If the query does not validate it returns false. 

            if ($userModel->insert($data)) {

                //false
                echo $userModel->getLastQuery();
            } else {   //success
                $userCompanyModel->insert($companyData);
                return redirect()->to('/');
            }
            
            

            

        } else {
            echo 'failed by validation';
        }
    }
}
