<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/panel').
            view('Base/footer')
        ;
    }

    public function getUserByActive($a)
    {
        $userModel = new UserModel();
        $data['user_data'] = $userModel->select("*")->where('active', $a)->findAll();
     
        if ($a == 'y') {

            $data['header'] = "Lista Aktywnych Użytkowników";

            return view('Base/header', [
                'title' => 'Aktywni Użytkownicy'
            ]).
            view('Panels/panel-active-users', $data).
            view('Base/footer')
        ;
        } else if($a == 'n') {

            $data['header'] = "Lista Nieaktywnych Użytkowników";

            return view('Base/header', [
                'title' => 'Nieaktywni Użytkownicy'
            ]).
            view('Panels/panel-active-users', $data).
            view('Base/footer')
        ;
        } 

       
    }
}
