<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserService;

class UserServiceImpl implements UserService
{

    function login(string $user, string $password): bool
    {
        $user = User::where('username', $user)->first();
        return password_verify($password, $user?->password ?? '');
    }

    function register(string $user, string $password): bool
    {
        $user = User::create([
            'username' => $user,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);

        return true;
    }
}
