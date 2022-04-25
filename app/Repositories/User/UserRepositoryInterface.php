<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getUserList();
    public function getUser($id);
}
