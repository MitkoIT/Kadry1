<?php

namespace App\Models;

use CodeIgniter\Model;

class UserNotificationModel extends Model
{
    protected $table = 'user_notification';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [ 
        'user_id',
        'type',
        'is_active'
    ];

    protected function getUserNotifications(int $userId): array
    {
        return $this
            ->select('type')
            ->where('user_id', $userId)
            ->where('is_active', 1)
            ->findAll()
        ;
    }

    protected function deactiveUserNotifications(int $userId): void
    {
        $this
            ->set('is_active', null)
            ->where('user_id', $userId)
            ->where('is_active', 1)
            ->update()
        ;
    }

    public function parseUserNotifications(int $userId): array
    {
        $notifications = $this->getUserNotifications($userId);

        $this->deactiveUserNotifications($userId);

        return $notifications;
    }

    public function setUserNotification(
        int $userId,
        string $type
    ): void
    {
        $this->insert([
            'user_id' => $userId,
            'type' => $type,
            'is_active' => 1
        ]);
    }
}
