<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetSemiownerModel extends Model
{
    protected $table = 'd_budzet_zastepca';
    protected $allowedFields = [ 
        'id_budzet',
        'id_zastepca'
    ]; 
}
