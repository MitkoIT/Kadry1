<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCompanyModel extends Model
{
    protected $table = 'user_company';
    protected $primaryKey = 'id_user_company';

    public function getUsersCompany(): array
    {    
        $response = [];
        $data = $this
            ->join('company', 'company.idcompany = user_company.id_company')
            ->findAll()
        ;

        foreach ($data as $element) {
            $response[$element['id_user']][] = $element['name'];
        }

        return $response;
    }
}