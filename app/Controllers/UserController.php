<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;

class UserController extends BaseController
{
    public function editUserDataForAdd()
    {
        helper(['form']);

        $companyModel = new CompanyModel();

        $data = [
            'company_list'  => $companyModel->getAllCompanies(),
            'header'        => 'Dodaj Użytkownika',
            'validation'    =>  $this->validator
        ];

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
           // view('Panels/side-bar').
            view('Panels/main-add', $data).
            view('Base/footer');
    }

    public function setUserDataForAdd()
    {
        helper(['form']);
        $rules = [
            'email' => 'required|min_length[4]|max_length[128]|valid_email|',
            'firma' => 'required',
            'name'  => [
                'rules' => 'required|min_length[2]|Max_length[128]',
                'label' => 'Name',
                'errors' => [
                    'required' => 'Musisz wprowadzić nazwisko i imię.',
                    'min_length' => 'Minimum 2 znaki w Imię i Nazwisko.',
                    'max_length' => 'Maksimum 128 znaków w Imię i Nazwisko.'
                ]
            ], 
            'phone' => [
                'rules' => 'required|min_length[2]|Max_length[20]',
                'label' => 'Phone',
                'errors' => [
                    'required' => 'Musisz wprowadzić numer telefonu.',
                    'min_length' => 'Minimum 2 cyfry w numerze telefonu.',
                    'max_length' => 'Maksimum 20 cyfr w numerze telefonu.'
                ]
            ], 
        ]; 
          
        if ($this->validate($rules)) { 
            $userModel = new UserModel();
            $userCompanyModel = new UserCompanyModel();
            
            $data = [ 
                'idusers'               => $userModel->getNextId(),
                'name'                  => $this->request->getPost('name'),
                'email'                 => $this->request->getPost('email'),
                'phone_shop_mitko'      => $this->request->getPost('phone'),
                'active'                => 'n'
            ]; 

            $companyData = [
                'id_user'       => $data['idusers'],
                'id_company'    => $this->request->getPost('firma')
            ];

            //In Insert:
            //Your $success is returning the result not false.
            //If the query does not validate it returns false. 

            $userModel->insert($data);
            $userCompanyModel->insert($companyData);

            $this->sendEmailSetPassword($data['idusers']['next_id'], $data['email']);


            session()->setFlashdata('success', 'Użytkownik został dodany poprawnie.');
            return redirect()->to('/');
        } else {
            return $this->editUserDataForAdd();
        }
    }

    public function sendEmailSetPassword(int $id, string $emailto)
    {

        $email = service('email');
        $email->setFrom('tomasz.rynka@mitko.pl', 'Rynka Tomasz');
        $email->setTo($emailto); 
        $email->setSubject('Nowy Użytkownika na firma.mitko.pl');

        $clientData['id'] = $id;

        ob_start();
            echo view('Base/header', [
                'title' => 'Nowy Użytkownik'
            ]).
                view('Base/email', $clientData);
            $output = ob_get_contents();
        ob_end_clean();

        $email->setMessage($output);
        $email->send();
    }

    
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

        $data = [
            'user_data'     => $userModel->getUserById($id),
            'validation'    => $this->validator
        ];

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
                    'min_length' => 'Minimum 8 znaków.',
                    'regex_match' => 'Aby Twoje hasło było silne i bezpieczne, 
                                        powinno zawierać 4 z 4 grup znakowych – 
                                        co najmniej jedna mała oraz wielka litera, 
                                        a także jeden znak specjalny (np. !, @, $) i jedną cyfre.'
                ]
            ], 
            'confirmpasswd' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Wprowadzone hasła muszą być identyczne.'
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
                session()->setFlashdata(
                'success',
                 'Hasło użytkownika zostało ustawione poprawnie.'
                );
                return redirect()->to('pass-success');
            } else {
                echo 'password update failed';
            }

        } else {
            //zwracam metode zeby zachowac validatora
           return $this->editUserPassword($id);
        }
    }

    public function editUserDataForEdit(int $id, int $companyId)
    {
        helper(['form']);

        $userModel = new UserModel();
        $companyModel = new CompanyModel();

        $data = [
            'user_data'     => $userModel->getUserById($id),
            'company_list'  => $companyModel->getAllCompanies(),
            'company_data'  => $companyModel->getCompanyById($companyId),
            'header'        => 'Edytuj Użytkownika',
            'validation'    => $this->validator    
        ];
      
        return view('Base/header', [
                'title' => 'Edytu Użytkownika'
            ]).
           // view('Panels/side-bar').
            view('Panels/main-edit', $data).
            view('Base/footer');
    }

    public function setUserDataForEdit(int $id, int $idcompany)
    {
        helper(['form']);

        $rules = [
            'email' => 'required|min_length[4]|max_length[128]|valid_email|',
            'firma' => 'required',
            'name'  => [
                'rules' => 'required|min_length[2]|Max_length[128]',
                'label' => 'Name',
                'errors' => [
                    'required' => 'Musisz wprowadzić nazwisko i imię.',
                    'min_length' => 'Minimum 2 znaki w Imię i Nazwisko.',
                    'max_length' => 'Maksimum 128 znaków w Imię i Nazwisko.'
                ]
            ], 
            'phone' => [
                'rules' => 'required|min_length[2]|Max_length[20]',
                'label' => 'Phone',
                'errors' => [
                    'required' => 'Musisz wprowadzić numer telefonu.',
                    'min_length' => 'Minimum 2 cyfry w numerze telefonu.',
                    'max_length' => 'Maksimum 20 cyfr w numerze telefonu.'
                ]
            ], 
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

                if ($userCompanyModel
                ->update($userCompanyModel
                    ->getUserCompanyByData(
                        $id, $idcompany
                    ), 
                    $companyData
                )) {
                    
                   // $lastQuery = $userCompanyModel->getLastQuery();
                   // echo $lastQuery; // wyswietl ostatnia kwerende
                   // echo $companyData['id_company'];
                   session()->remove('error');
                   session()->setFlashdata(
             'success', 
            'Dane Użytkownika zostały zapisane poprawnie.'
                    );

                  return redirect()->to('edit/'. $id . '/' . $companyData['id_company']);
                } else {
                    echo 'failed... company update';
                }
            } else {
                echo 'failed... user update';
            }

        } else {
            session()->remove('success');
            session()->setFlashdata(
                'error', 
               'Dane Użytkownika nie zostały zapisane poprawnie.'
            );
            //return redirect()->to('edit/'. $id . '/' . $idcompany);
            return $this->editUserDataForEdit($id, $idcompany);
        }
    }
}
