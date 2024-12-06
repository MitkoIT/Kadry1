<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\FormatLibrary;

class UserCompanyModel extends Model
{
    protected $table = 'user_company';
    protected $primaryKey = 'id_user_company';
    protected $allowedFields = [ 
        'id_user_company',
        'id_user',
        'id_company'
    ]; 

    public function getUsersCompany(): array
    {    
        $response = [];
        $data = $this
            ->join('company', 'company.idcompany = user_company.id_company')
            ->findAll()
        ;

        foreach ($data as $element) {
            $response[$element['id_user']][] = $element['name'];
        }

        return $response;
    }

    public function getUserCompany(int $userId): array
    {    
        $response = [];
        $data = $this
            ->select('
                idcompany AS id,
                name
            ')
            ->join('company', 'company.idcompany = user_company.id_company')
            ->where('id_user', $userId)
            ->findAll()
        ;

        foreach ($data as $element) {
            $response[] = (new FormatLibrary())->toObject($element);
        }

        return $response;
    }

    public function setUserCompany(
        int $userId,
        array $userCompanies,
        array $companies
    ): void
    {
        $this
            ->where(['id_user' => $userId])
            ->delete()
        ;

        foreach ($userCompanies as $index => $userCompany) {
            foreach ($companies as $company) {
                if ($company->name === $index) {
                    $this->insert([
                        'id_user' => $userId,
                        'id_company' => $company->id
                    ]);
                }
            }
        }
    }
}