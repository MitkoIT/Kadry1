<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'd_budzet';


    protected $allowedFields = [ 
        'budzet_nazwa',
        'id_cel',
        'id_firma'
    ]; 


    public function getAllBudgets()
    {
        return $this->findAll();
    }

     //This one is for search
    //searches by first letter
    public function getBudgetByFirstLetter(string $name)
    {
        return $this
        ->select('*')
        ->like('budzet_nazwa', $name)
        ->findAll();
    }
}
