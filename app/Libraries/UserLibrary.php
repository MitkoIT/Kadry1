<?php

namespace App\Libraries;

use App\Models\UserModel;
use App\Libraries\FormatLibrary;

class UserLibrary
{
    public function getSessionDetails(array $session): \stdClass
    {
        return (new FormatLibrary())->toObject([
            'name' => $session['name'],
            'role' => $session['role']
        ]);
    }

    public function getUserDetails(int $userId): \stdClass
    {
        return
            (new UserModel())
            ->getUserDetails($userId)
        ;
    }

    public function getUsers(string $type = null): array
    {
        return (new UserModel())->getUsers($type);
    }
}
