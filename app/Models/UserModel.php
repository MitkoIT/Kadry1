<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'users';
    protected $primaryKey = 'idusers';
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 
        'name',
        'email',
        'password',
        'idusers',
        'phone_shop_mitko',
        'photo',
        'position',
        'role',
        'phone',
        'id_user_optima',
        'active'
    ]; 

    public function getPaginatedAllUsers($perPage, $page)
    {
        return $this->select('*, users.name as user_name, users.email as user_email, 
            company.name as company_name, company.email as company_email')->join(
                'user_company', 'user_company.id_user = users.idusers', 'left')->join(
                    'company', 'company.idcompany = user_company.id_company', 'left')->paginate(
                        $perPage, 'default', $page); // Use paginate method
    }

    public function getPaginatedANUsers(int $perPage, $page, string $a)
    {
        if ($a == 'y' || $a == 'n') {
            return $this->select('*, users.name as user_name, users.email as user_email, 
                company.name as company_name, company.email as company_email')->join(
                'user_company', 'user_company.id_user = users.idusers', 'left')->join(
                    'company', 'company.idcompany = user_company.id_company', 'left')->where('active', $a)->paginate($perPage, $page); 
        } else {
            return redirect()->to('/');
        }
    }
}
