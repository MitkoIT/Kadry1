<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;
use App\Models\UserNoteModel;

class UserController extends BaseController
{
    public function getAllUsersWithCompanys()
    {
        helper(['form']);

        $userModel = new UserModel();
        $perPage = 1000;
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
            view('Panels/side-bar').
            view('Panels/main-user', $data).
            view('Base/footer');
    }

    public function getAllUsers()
    {
        helper(['form']);

        $userModel = new UserModel();
        $companyModel = new UserCompanyModel();
        $perPage = 1000;
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

        
        //echo var_dump($data['user_data']);
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
        $perPage = 1000;
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
            view('Panels/side-bar').
            view('Panels/main-user', $data).
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
            view('Panels/side-bar').
            view('Panels/main-user', $data).
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
            $perPage = 1000;
            $page = $this->request->getVar('page') ?: 1;
		    $total = $userModel->countAll();
            $data['user_data'] = $userModel
                ->getUsersByFirstLetterWithCompanys(
                $this->request->getVar('name'),
                $perPage,
                $page
            );
            if ($total > $perPage) {
            $data['pager'] = $userModel->pager;
            } else {
                $data['pager'] = null; // No pager needed
            }
            //$data['pager'] = $userModel->pager;
            $data['header'] = 'Wyniki Wyszukiwania';

            return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main-user', $data).
            view('Base/footer');            

        } else {
            return redirect()->to('/');
        }
    }

    public function deleteUserCompanyElement(int $userId, int $companyId)
    {
        $userCompanyModel = new UserCompanyModel();
        $idToDelete = $userCompanyModel->getUserCompanyByData($userId, $companyId);

        $userCompanyModel->deleteById($idToDelete);

       
        return redirect()->to('user-edit/'. $userId);
    }

    public function addUserCompanyElement(int $userId)
    {
        $userCompanyModel = new UserCompanyModel();

        $data = [
            'id_user'       => $userId,
            'id_company'    => 1
        ];

        $userCompanyModel->insert($data);

        return redirect()->to('user-edit/'. $userId);
    }

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
            view('Panels/side-bar').
            view('Panels/main-user-add', $data).
            view('Base/footer');
    }

    public function setUserDataForAdd()
    {
        helper(['form']);
        $rules = [
            'email' => 'required|min_length[4]|max_length[128]|valid_email|',
            'firmy' => 'required',
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
            $userNoteModel = new UserNoteModel();
            
            $data = [ 
                'idusers'               => $userModel->getNextId(),
                'name'                  => $this->request->getPost('name'),
                'email'                 => $this->request->getPost('email'),
                'phone'                 => $this->request->getPost('phone'),
                'active'                => 'n',
            ]; 

            //In Insert:
            //Your $success is returning the result not false.
            //If the query does not validate it returns false. 

            $userModel->insert($data);


            $firmy = $this->request->getPost('firmy');
            foreach ($firmy as $firma) {
                $companyData = [
                    'id_user'       => $data['idusers'],
                    'id_company'    => $firma
                ];
                $userCompanyModel->insert($companyData);
            }

            $noteData = [
                'user_id'   => $data['idusers'],
                'note'      => $this->request->getPost('notatka')
            ];

            $userNoteModel->insert($noteData);

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

    public function editUserDataForEdit(int $id)
    {
        helper(['form']);

        $userModel = new UserModel();
        $companyModel = new CompanyModel();
        $userCompanyModel = new UserCompanyModel();
        $userNoteModel = new UserNoteModel();

        $companysData = [];

        $companyIds = $userCompanyModel->getCompanyIdByUserId($id);
        foreach ($companyIds as $companyId) {
            array_push($companysData, $companyModel->getCompanyById($companyId['id_company']));
        }
       
        

        $data = [
            'user_data'     => $userModel->getUserById($id),
            'company_list'  => $companyModel->getAllCompanies(),
            'company_num'   => $userCompanyModel->getNumOfCompaniesForUserId($id),
            'company_data'  => $companysData,
            'header'        => 'Edytuj Użytkownika',
            'validation'    => $this->validator,
            'note'          => $userNoteModel->GetUserNote($id)  
        ];
      
        return view('Base/header', [
                'title' => 'Edytu Użytkownika'
            ]).
            view('Panels/side-bar').
            view('Panels/main-user-edit', $data).
            view('Base/footer');
    }

    public function setUserDataForEdit(int $userId)
    {
        helper(['form']);

        $rules = [
            'email' => 'required|min_length[4]|max_length[128]|valid_email|',
            //'firmy' => 'required',
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
                'phone'      => $this->request->getPost('phone'),
            ]; 

            if ($userModel->update($userId, $data)) {

                session()->remove('error-user-data');
                session()->setFlashdata(
             'success-user-data', 
            'Dane Użytkownika zostały zapisane poprawnie.'
                );
               return redirect()->to('user-edit/'. $userId);
               //$lastQuery = $userCompanyModel->getLastQuery();
                //echo $lastQuery; // wyswietl ostatnia kwerende     
            } 
        } else {
            session()->remove('success-user-data');
            session()->setFlashdata(
            'error-user-data', 
           'Dane Użytkownika nie zostały zapisane poprawnie.'
            );
            //return redirect()->to('edit/'. $id . '/' . $idcompany);
            return $this->editUserDataForEdit($userId);
        }
    }

    public function updateUserNote(int $userId)
    {
        helper(['form']);

        $userNoteModel = new UserNoteModel();

        $data = [
            'note' => $this->request->getPost('notatka'),
            'user_id' => $userId // Ensure the user_id is included in the data
        ];

        // Check if a record exists for the given user_id
        $existingNote = $userNoteModel->where('user_id', $userId)->first();

        if ($existingNote) {
            // If the record exists, update it
            if (!$userNoteModel->where('user_id', $userId)->set($data)->update()) {
                session()->remove('success-user-company');
                session()->setFlashdata(
                    'error-user-note', 
                    'Notatka Użytkownika nie została zapisana poprawnie.'
                );
                return $this->editUserDataForEdit($userId);
            }

            session()->remove('error-user-company');
            session()->setFlashdata(
                'success-user-note', 
                'Notatka została zaktualizowana poprawnie.'
            );
        } else {
            // If the record does not exist, create a new one
            if (!$userNoteModel->insert($data)) {
                session()->remove('success-user-company');
                session()->setFlashdata(
                    'error-user-note', 
                    'Notatka Użytkownika nie została zapisana poprawnie.'
                );
                return $this->editUserDataForEdit($userId);
            }

            session()->remove('error-user-company');
            session()->setFlashdata(
                'success-user-note', 
                'Notatka została zapisana poprawnie.'
            );
        }

        return redirect()->to('user-edit/' . $userId);
    }

    public function setUserCompanyForEdit(int $userId)
    {
        helper(['form']);

        $rules = [
            'firmy' => 'required'
        ]; 
          
        if ($this->validate($rules)) { 
            $userCompanyModel = new UserCompanyModel();

            //pobieram nowe dane
            $firmy = $this->request->getPost('firmy');
            //pobieram wszystkie id's z tabeli user_company gdzie id_user = userId
            $entries = $userCompanyModel->getUserCompanyIdByUserId($userId);
            //pobieram ilosc wystapien uzytkownika w tabeli user_company
            $amount = $userCompanyModel->getNumOfCompaniesForUserId($userId);

            //wypelnij wpisy w user_company nowymi danymi
            for ($i=0; $i<$amount;$i++) {

                $companyData = [
                    'id_user'       => $userId,
                    'id_company'    => $firmy[$i]
                ];
                if (!$userCompanyModel
                    ->update($entries[$i],$companyData)) {
                        
                    session()->remove('success-user-company');
                    session()->setFlashdata(
                    'error-user-company', 
                   'Dane Użytkownika nie zostały zapisane poprawnie.'
                    );
                    //return redirect()->to('user-edit/'. $id . '/' . $idcompany);
                    return $this->editUserDataForEdit($userId);
                }  
            }

            session()->remove('error-user-company');
            session()->setFlashdata(
        'success-user-company', 
        'Firmy zostały przypisane poprawnie'
            );
            return redirect()->to('user-edit/'. $userId);
        }
    }
}
