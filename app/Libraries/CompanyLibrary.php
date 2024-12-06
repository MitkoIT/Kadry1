<?php

namespace App\Libraries;

use App\Models\CompanyModel;

class CompanyLibrary
{
    public function getCompanies(): array
    {
        return (new CompanyModel())->getCompanies();
    }

    public function getCompanyDetails(int $companyId): \stdClass
    {
        return (new CompanyModel())
            ->getCompanyDetails($companyId)
        ;
    }
}
