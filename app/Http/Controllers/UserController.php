<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuperAdminRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function createSuperAdmin(CreateSuperAdminRequest $request){
        return $this->userService->createSuperAdmin($request);
    }
}
