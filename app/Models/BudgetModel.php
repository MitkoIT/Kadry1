<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'd_budzet';
    protected $tabled_firma = 'd_firma';
    protected $tabled_cel = 'd_cel';

    protected $allowedFields = [ 
        'budzet_nazwa',
        'id_cel',
        'id_firma'
    ]; 


    public function getAllBudgets()
    {
        return $this->findAll();
    }

    public function getAllBudgetsWithCompany()
    {
        return $this
        ->select('d_budzet.* , d_firma.firma_nazwa')
        ->join('d_firma', 'd_firma.id_firma = d_budzet.id_firma', 'left')
        ->findAll();
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

    public function getBudgetByFirstLetterWithCompany(string $name)
    {
        return $this
        ->select('d_budzet.*, d_firma.firma_nazwa')
        ->join('d_firma', 'd_firma.id_firma = d_budzet.id_firma', 'left')
        ->like('budzet_nazwa', $name)
        ->findAll();
    }

    public function getBudgetById(int $id)
    {
        return $this->where('id_budzet', $id)->first();
    }

    public function getBudgetByIdWithCompany(int $id)
    {
        return $this
        ->select('d_budzet.*, d_firma.firma_nazwa')
        ->join('d_firma', 'd_firma.id_firma = d_budzet.id_firma', 'left')
        ->where('id_budzet', $id)->first();
    }

    public function getAllBudgetCompanys()
    {
        return $this
        ->db->table($this->tabled_firma)
        ->get()->getResultArray(); //get and getResult() instead first and findAll()
    }

    public function getAllBudgetTargets()
    {
        return $this
        ->db->table($this->tabled_cel)
        ->get()->getResultArray();
    }
}
