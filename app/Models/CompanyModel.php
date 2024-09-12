<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'company';
    protected $primaryKey = 'idcompany';
    protected $useAutoIncrement = true;

    protected $allowedFields = [ 
        'name',
        'email',
        'catchworld',
        'logourl'
    ]; 

    public function getCompanyById(int $id)
    {
        return $this->find($id);
    }

    public function getCompanyByName(string $name)
    {
        return $this->find($name);
    }

    public function getAllCompanies()
    {
        return $this->findAll();
    }
}
