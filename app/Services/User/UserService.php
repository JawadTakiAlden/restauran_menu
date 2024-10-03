<?php

namespace App\Services\User;

use App\Http\Requests\CreateSuperAdminRequest;
use App\Repositories\User\UserRepoI;

class UserService
{
    public function __construct(protected UserRepoI $userRepo)
    {
    }

    public function createSuperAdmin(CreateSuperAdminRequest $request){
        return $this->userRepo->createSuperAdmin($request);
    }
}
