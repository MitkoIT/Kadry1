<?php

namespace App\Libraries;

use App\Models\UserModel;
use App\Models\UserCompanyModel;
use App\Models\UserLoginModel;

class EmployeeLibrary
{
    private UserModel $userModel;
    private UserCompanyModel $userCompanyModel;
    private UserLoginModel $userLoginModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userCompanyModel = new UserCompanyModel();
        $this->userLoginModel = new UserLoginModel();
    }

    public function getEmployees(string $type = null): array
    {
        return [
            'users' => $this->userModel->getUsers($type),
            'companies' => $this->userCompanyModel->getUsersCompany(),
            'logins' => $this->userLoginModel->getUsersLogin()
        ];
    }

    public function deactivateEmployee(int $userId): bool
    {
        return $this->userModel->deactivateUser($userId);
    }
}
