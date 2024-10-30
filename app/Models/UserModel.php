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
        'phone',
        'active', 
        'password'
    ]; 

    public function getAllUsers()
    {
        return $this->findAll();
    }

    public function getPaginatedAllUsersWithCompanys(int $perPage, $page)
    {
        return $this
        ->select(
            'users.idusers, 
            users.active, 
            users.phone, 
            users.name AS user_name, 
            users.email AS user_email, 
            GROUP_CONCAT(DISTINCT company.name SEPARATOR ", ") AS company_name, 
            GROUP_CONCAT(DISTINCT company.email SEPARATOR ", ") AS company_email'
            )
        ->join( 'user_company', 'user_company.id_user = users.idusers', 'left')
        ->join('company', 'company.idcompany = user_company.id_company', 'left')
        ->groupBy('users.idusers')
        ->orderBy('users.idusers')
        ->paginate($perPage, 'default', $page);
    }

    public function getPaginatedAllUsers(int $perPage, $page)
    {
        return $this
        ->select('*, users.name as user_name, users.email as user_email')
        ->orderby('idusers')
        ->paginate($perPage, 'default', $page); // Use paginate method
    }

    public function getPaginatedANUsersWithCompanys(int $perPage, $page, string $a)
    {
        if ($a == 'y' || $a == 'n') {
            return $this
            ->select('users.idusers, 
            users.active, 
            users.phone, 
            users.name AS user_name, 
            users.email AS user_email, 
            GROUP_CONCAT(DISTINCT company.name SEPARATOR ", ") AS company_name, 
            GROUP_CONCAT(DISTINCT company.email SEPARATOR ", ") AS company_email')
            ->join(  'user_company', 'user_company.id_user = users.idusers', 'left')
            ->join('company', 'company.idcompany = user_company.id_company', 'left')
            ->where('active', $a)
            ->groupBy('users.idusers')
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
    //searches by first letter
    public function getUsersByFirstLetterWithCompanys(string $name, int $perPage, $page)
    {
        return $this
        ->select('users.idusers, 
        users.active, 
        users.phone, 
        users.name AS user_name, 
        users.email AS user_email, 
        GROUP_CONCAT(DISTINCT company.name SEPARATOR ", ") AS company_name, 
        GROUP_CONCAT(DISTINCT company.email SEPARATOR ", ") AS company_email')
        ->join('user_company', 'user_company.id_user = users.idusers', 'left')
        ->join('company', 'company.idcompany = user_company.id_company', 'left')
        ->groupBy('users.idusers')
        ->like('users.name', $name)
        ->paginate($perPage, $page);
    }

    public function getNextId()
    {
        return $this
        ->select('COALESCE(MAX(idusers), 0) + 1 AS next_id')
        ->first();
    }
}
