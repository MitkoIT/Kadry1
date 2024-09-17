<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'users';
    protected $primaryKey = 'idusers';    
    protected $allowedFields = [ 
        'idusers',
        'name',
        'email',
        'phone_shop_mitko',
        'active', 
        'password'
    ]; 

    public function getPaginatedAllUsersWithCompany($perPage, $page)
    {
        return $this
        ->select('*, users.name as user_name, users.email as user_email, 
            company.name as company_name, company.email as company_email')
        ->join( 'user_company', 'user_company.id_user = users.idusers', 'left')
        ->join('company', 'company.idcompany = user_company.id_company', 'left')
        ->orderby('idusers')
        ->paginate($perPage, 'default', $page); // Use paginate method
    }

    public function getPaginatedANUsersWithCompany(int $perPage, $page, string $a)
    {
        if ($a == 'y' || $a == 'n') {
            return $this
            ->select('*, users.name as user_name, users.email as user_email, 
                company.name as company_name, company.email as company_email')
            ->join(  'user_company', 'user_company.id_user = users.idusers', 'left')
            ->join('company', 'company.idcompany = user_company.id_company', 'left')
            ->where('active', $a)
            ->paginate($perPage, $page); 
        } else {
            return redirect()->to('/');
        }
    }

    public function getUserById(int $id)
    {
        return $this->select('*')->where('idusers', $id)->first();
    }

    //This one is for search
    //searches by first letters
    public function getUsersByFirstLetterWithCompany(string $name, int $perPage, $page)
    {
        return $this
        ->select('*, users.name as user_name, users.email as user_email, 
            company.name as company_name, company.email as company_email')
        ->join('user_company', 'user_company.id_user = users.idusers', 'left')
        ->join('company', 'company.idcompany = user_company.id_company', 'left')
        ->like('users.name', $name, 'after')
        ->paginate($perPage, $page);
    }

    public function getNextId()
    {
        return $this
        ->select('COALESCE(MAX(idusers), 0) + 1 AS next_id')
        ->first();
    }
}
