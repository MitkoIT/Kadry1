<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\FormatLibrary;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'idusers';
    protected $returnType = 'object';
    protected $allowedFields = [ 
        'idusers',
        'name',
        'email',
        'phone',
        'active', 
        'password'
    ]; 

    public function getUsers(
        string $type = null,
        int $jobPositionId = null
    ): array
    {
        if (is_null($jobPositionId)) {
            if ($type === null) {
                return $this
                    ->select('
                        idusers AS id,
                        name,
                        email,
                        active, 
                        phone, 
                        role
                    ')
                    ->findAll()
                ;
            } elseif ($type === 'active') {
                return $this
                    ->select('
                        idusers AS id,
                        name,
                        email,
                        active, 
                        phone, 
                        role
                    ')
                    ->where('active', 'y')
                    ->findAll()
                ;
            } elseif ($type === 'unactive') {
                return $this
                    ->select('
                        idusers AS id,
                        name,
                        email,
                        active, 
                        phone, 
                        role
                    ')
                    ->where('active', 'n')
                    ->findAll()
                ;
            }
        } else {
            return $this
                ->select('
                    idusers AS id,
                    name,
                    email,
                    active, 
                    phone, 
                    role
                ')
                ->join('job_position_user', 'job_position_user.user_id = users.idusers')
                ->where('job_position_user.element_id', $jobPositionId)
                ->where('job_position_user.is_deleted', null)
                ->findAll()
            ;
        }
    }

    public function getUserDetails(int $userId): \stdClass
    {
        return $this
            ->select('
                idusers AS id,
                name,
                email,
                active, 
                phone, 
                role
            ')
            ->where('idusers', $userId)
            ->first()
        ;
    }

    public function setUser(int $userId = null, array $data): \stdClass
    {
        $success = null;
        $isActive = 'n';

        if (isset($data['isEmployeeActive'])) {
            $isActive = $data['isEmployeeActive'] === 'on' ? 'y' : 'n';
        }

        if ($userId === null) {
            $success = $this
                ->insert([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'active' => $isActive,
                ])
            ;

            $userId = $this->db->insertID();
        } else {
            $success = $this
                ->set([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'active' => $isActive,
                ])
                ->where('idusers', $userId)
                ->update()
            ;
        }

        return (new FormatLibrary())->toObject([
            'success' => $success,
            'userId' => $userId
        ]);
    }

    public function deactivateUser(int $userId): bool
    {
        return $this
            ->set(['active' => 'n'])
            ->where('idusers', $userId)
            ->update()
        ;
    }

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
