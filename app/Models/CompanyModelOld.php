<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'company';
    protected $primaryKey = 'idcompany';

    protected $allowedFields = [ 
        'name',
        'email',
        'catchworld',
        'logourl'
    ]; 

    public function getCompanyById(int $id)
    {
        return $this->where('idcompany', $id)->first();
    }

    public function getCompanyByName(string $name)
    {
        return $this->where('name', $name)->first();
    }

    public function getAllCompanies()
    {
        return $this->findAll();
    }
}
