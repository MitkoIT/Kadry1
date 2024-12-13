<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\FormatLibrary;

class JobPositionUserModel extends Model
{
    protected $table = 'job_position_user';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'element_id',
        'user_id',
        'is_deleted'
    ];

    public function getJobPositionUsers(): array
    {
        $response = [];
        $users = $this
            ->select('
                user_id AS userId,
                element_id AS elementId,
                name
            ')
            ->where('is_deleted', null)
            ->join('users', 'users.idusers = job_position_user.user_id')
            ->findAll()
        ;

        foreach ($users as $user) {
            $response[$user->elementId][] = $user;
        }

        return $response;
    }

    public function addJobPositionUser(
        int $jobPositionId,
        int $userId
    ): int
    {
        $this->insert([
            'element_id' => $jobPositionId,
            'user_id' => $userId
        ]);

        return $this->insertID();
    }

    public function deleteJobPositionUser(
        int $jobPositionId,
        int $userId
    ): int
    {
        return $this
            ->set('is_deleted', true)
            ->where('element_id', $jobPositionId)
            ->where('user_id', $userId)
            ->update()
        ;
    }
}
