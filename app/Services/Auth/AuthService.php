<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Repositories\Auth\AuthRepoI;

class AuthService
{
    public function __construct(
        protected AuthRepoI $authRepo
    ) {
    }

    public function login(LoginRequest $request){
        return $this->authRepo->login($request);
    }

    public function logout(){
        return $this->authRepo->logout();
    }
}
