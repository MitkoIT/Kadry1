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
            //komunikat o tym czy napewno chcesz go dezaktywowac i informacja ze jest dezaktywowany
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }

    public function editUserPassword(int $id)
    {
        helper(['form']);

        $userModel = new UserModel();

        $data['user_data'] = $userModel->getUserById($id);

        if ($data['user_data']) {
            if ($data['user_data']['active'] == 'n' && 
                $data['user_data']['password'] == '') {
               
                $data['header'] = 'Ustaw hasło dla użytkownika ';

                return view('Base/header', [
                    'title' => 'Ustaw pierwsze hasło użytkownika'
                ]).
                view('Panels/main-passwd-first', $data).
                view('Base/footer');

            } else {

                //TODO: zmiana hasla uzytkownika istniejacego i z ustawiony haslem
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function setUserPassword(int $id)
    {
        helper(['form']);

        $rules = [
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'label' => 'Password',
                'errors' => [
                    'required' => 'Musisz wprowadzić hasło.',
                    'min_length' => 'Minimum 8 znaków',
                    'regex_match' => 'Aby Twoje hasło było silne i bezpieczne, powinno zawierać 4 z 4 grup znakowych – 
                                        co najmniej jedna mała oraz wielka litera, a także jeden znak specjalny (np. !, @, $) i jedną cyfre.'
                ]
            ], 
            'confirmpasswd' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Wprowadzone hasła muszą być identyczne'
                ]
            ],
        ];

        $userModel = new UserModel();

        if ($this->validate($rules)) {
            $data = [
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'active'    => 'y'
            ];

            if ($userModel->update($id, $data)) {
                session()->setFlashdata('success', 'Hasło użytkownika zostało ustawione poprawnie.');
                return redirect()->to('pass-success');
            } else {
                echo 'password update failed';
            }

        } else {
            $data = [
                'user_data' => $userModel->getUserById($id),
                'header'    => 'Ustaw hasło dla użytkownika ',
                'validation' => $this->validator
            ];

            return view('Base/header', [
                'title' => 'Ustaw pierwsze hasło użytkownika'
            ]).
            view('Panels/main-passwd-first', $data).
            view('Base/footer');
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
                   session()->setFlashdata('success', 'Dane Użytkownika zostały zapisane poprawnie.');
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