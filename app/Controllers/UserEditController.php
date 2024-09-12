<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserEditController extends BaseController
{
    public function index()
    {
        helper(['form']);

        return view('Base/header', [
                'title' => 'Edytuj Użytkownika'
            ]).
            view('Panels/side-bar').
            view('Panels/main-search', [
                'header' => 'Edytuj Użytkownika'
            ]).
            view('Base/footer');
    }

    public function getUser()
    {
        helper(['form']);
        $rules = [
            'name'  => 'required|min_length[2]|max_length[128]'
        ]; 

        if ($this->validate($rules)) {

            $userModel = new UserModel();

            $data = $userModel->where('name', $this->request->getVar('name'))->findAll();

            if ($data) {
                echo var_dump($data);
            } else {
                $data['header'] = 'Edytuj Użytkownika';
                $data[''] = '';
                return view('Base/header', [
                    'title' => 'Edytuj Użytkownika'
                ]).
                view('Panels/side-bar').
                view('Panels/main-search', $data).
                view('Base/footer');
            } 

        } else {
            $data['validation'] = $this->validator;
            $data['header'] = 'Edytuj Użytkownika';
            return view('Base/header', [
                'title' => 'Edytuj Użytkownika'
            ]).
            view('Panels/side-bar').
            view('Panels/main-search', $data).
            view('Base/footer');
        }
    }
}