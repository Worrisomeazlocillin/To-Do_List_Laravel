<?php

namespace App\Services;

interface UserService
{
    function login(string $user, string $password): bool;
    function register(string $user, string $password): bool;
}
