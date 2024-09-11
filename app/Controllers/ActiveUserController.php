<?php

namespace App\Controllers;

use App\Models\UserModel;

class ActiveUserController extends BaseController
{
    public function getUserByActive($a)
    {
        $userModel = new UserModel();

        $data['user_data'] = 
            $userModel->select('*, users.name as user_name, users.email as user_email, 
            company.name as company_name, company.email as company_email')->join('user_company', 'user_company.id_user = users.idusers', 'left')->join(
            'company', 'company.idcompany = user_company.id_company', 'left')->where('active', $a)->findAll();
        //TODO: wyników może być bardzo dużo i przydał by się 'pager'

        if ($a == 'y') {

            $data['header'] = "Lista Aktywnych Użytkowników";

            return view('Base/header', [
                    'title' => 'Aktywni Użytkownicy'
                ]).
                view('Panels/side-bar').
                view('Panels/main-active-users', $data).
                view('Base/footer');
        } else if($a == 'n') {

            $data['header'] = "Lista Nieaktywnych Użytkowników";

            return view('Base/header', [
                    'title' => 'Nieaktywni Użytkownicy'
                ]).
                view('Panels/side-bar').
                view('Panels/main-active-users', $data).
                view('Base/footer');
        } else {
            return redirect()->to('/');
        }

       
    }
}
