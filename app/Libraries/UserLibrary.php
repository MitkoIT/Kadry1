<?php

namespace App\Libraries;

use App\Models\UserModel;
use App\Models\UserNotificationModel;
use App\Libraries\FormatLibrary;

class UserLibrary
{
    private UserModel $userModel;
    private UserNotificationModel $userNotificationModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userNotificationModel = new UserNotificationModel();
    }

    public function getSessionDetails(array $session): \stdClass
    {
        return (new FormatLibrary())->toObject([
            'id' => $session['id_user'],
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

    public function setUserNotification(
        int $userId,
        string $type
    ): void
    {
        $this->userNotificationModel->setUserNotification(
            $userId,
            $type
        );
    }

    public function getUserNotifications(int $userId): array
    {
        return $this->userNotificationModel->parseUserNotifications($userId);
    }
}
