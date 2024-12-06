<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'idcompany';
    protected $returnType = 'object';

    public function getCompanies(): array
    {
        return $this
            ->select('
                idcompany AS id,
                name,
                email
            ')
            ->findAll()
        ;
    }

    public function getCompanyDetails(int $companyId): \stdClass
    {
        return $this
            ->select('
                idcompany AS id,
                name,
                email
            ')
            ->where('idcompany', $companyId)
            ->first()
        ;
    }
}
