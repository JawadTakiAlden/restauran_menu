<?php

namespace App\Repositories\User;

use App\AppRoles;
use App\Http\Requests\CreateSuperAdminRequest;
use App\Http\Resources\SuperAdmin\SUserResource;
use App\HttpResponse\HTTPResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepo implements UserRepoI
{
    use HTTPResponse;
    public function createSuperAdmin(CreateSuperAdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create($request->only(['email' , 'password' , 'username']));
            $user->assignRole(AppRoles::SUPER_ADMIN);
            $user->syncPermissions($request->permissions);
            DB::commit();
            return $this->success(SUserResource::make($user));
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }
}
