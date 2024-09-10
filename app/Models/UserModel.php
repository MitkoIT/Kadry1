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
        'phone_shop_mitko'
    ]; 
}
