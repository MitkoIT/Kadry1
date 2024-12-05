<?php 

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class NoAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
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

            return redirect()->to('/');
        
        }

        if(session()->has('id_user')) {
//
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}