<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCompanyModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'user_company';
    protected $primaryKey = 'id_user_company';

    protected $allowedFields = [ 
        'id_user',
        'id_company'
    ]; 

    public function getUserCompanyByData(
        int $userid, 
        int $companyid
    ) {
        
        return $this
        ->select('id_user_company')
        ->where( 'id_user', $userid)
        ->where('id_company', $companyid)
        ->first();
    }

    public function getUserCompanyByUserId(
        int $userid
    ) {
        
        return $this
        ->select('id_user_company')
        ->where( 'id_user', $userid)
        ->findAll();
    }
}
