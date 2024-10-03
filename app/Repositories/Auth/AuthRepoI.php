<?php

namespace App\Repositories\Auth;

use App\Http\Requests\LoginRequest;

interface AuthRepoI
{
    public function login(LoginRequest $request);

    public function logout();
}
