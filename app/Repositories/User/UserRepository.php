<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Scopes\UserStatusScope;

class UserRepository implements UserRepositoryInterface
{
    public function getUserList()
    {
        return User::withoutGlobalScope(UserStatusScope::class)->where('is_admin', false)->get();
    }

    public function getUser($id)
    {
        return User::withoutGlobalScope(UserStatusScope::class)->findOrFail($id);
    }

    public function getAdminUsers()
    {
        return User::withoutGlobalScope(UserStatusScope::class)->where('is_admin', true)->get();
    }
}
