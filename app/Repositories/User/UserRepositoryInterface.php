<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getUserList();

    public function getUser($id);

    public function getAdminUsers();

    public function markReadNotification($id);

    public function markReadAllNotifications();
}
