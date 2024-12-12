<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\FormatLibrary;

class JobPositionUserModel extends Model
{
    protected $table = 'job_position_user';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    public function getJobPositionUsers(): array
    {
        $response = [];
        $users = $this
            ->select('
                user_id AS userId,
                element_id AS elementId,
                name
            ')
            ->where('active', 'y')
            ->join('users', 'users.idusers = job_position_user.user_id')
            ->findAll()
        ;

        foreach ($users as $user) {
            $response[$user->elementId][] = $user;
        }

        return $response;
    }
}
