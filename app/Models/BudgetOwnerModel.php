<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetOwnerModel extends Model
{
   protected $table = 'd_budzet_wlasciciel';
   protected $allowedFields = [ 
        'id_budzet',
        'id_wlasciciel'
    ]; 


}
