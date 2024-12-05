<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLoginModel extends Model
{
    protected $table = 'logg';
    protected $primaryKey = 'id_user_company';

    public function getUsersLogin(): array
    {    
        $response = [];
        $data = $this
            ->select('
                users_idusers AS id,
                date
            ')
            ->where('date >', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->orderBy('idlogg', 'DESC')
            ->findAll()
        ;

        foreach ($data as $element) {
            if (!isset($response[$element['id']])) {
                $response[$element['id']] = $element['date'];
            }
        }

        return $response;
    }
}