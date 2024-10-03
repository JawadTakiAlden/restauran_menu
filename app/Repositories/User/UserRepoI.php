<?php

namespace App\Repositories\User;

use App\Http\Requests\CreateSuperAdminRequest;

interface UserRepoI
{
    public function createSuperAdmin(CreateSuperAdminRequest $request);
}
