<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function login()
    {
        /*if (!empty($_GET['idu']) AND !empty($_GET['idapps'])) {
            $userModel = new UserModel();
            $user = $userModel->where('idusers', $_GET['idu'])->first();
            
            $data = array(
                'id_user' => $_GET['idu'],
                'id_apps' => $_GET['idapps'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => explode(',', $user['role']),
            );
            session()->set($data);*/

            return redirect()->to('/');
        
        /*}/* else {
            
            echo view('login/noAuth');
        
        }*/

        //return redirect()->to('/');
    }

    public function index() {

        if (!empty($_GET['idu']) AND !empty($_GET['idapps'])) {
            $userModel = new UserModel();
            $user = $userModel->where('idusers', $_GET['idu'])->first();
            
            $data = array(
                'id_user' => $_GET['idu'],
                'id_apps' => $_GET['idapps'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => explode(',', $user['role']),
            );
            session()->set($data);

            return redirect()->to('index');
        
        } else {
            
            echo view('login/noAuth');
        
        }
    }

    public function logout()
    { 
        $session = session();
        $session->destroy();
        return redirect()->to('/nie-zalogowany');
    }

    public function noAuth()
    { 
        return
            view('login/noAuth') 
        ;
    } 
}
