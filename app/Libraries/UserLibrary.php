<?php

namespace App\Libraries;

use App\Libraries\FormatLibrary;

class UserLibrary
{
    public function getUserDetails(array $session): \stdClass
    {
        return (new FormatLibrary())->toObject([
            'name' => $session['name'],
            'role' => $session['role']
        ]);
    }
}
