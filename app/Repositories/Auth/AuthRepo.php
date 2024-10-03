<?php

namespace App\Repositories\Auth;

use App\AppRoles;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\Res\UserResource;
use App\Http\Resources\SuperAdmin\SUserResource;
use App\HttpResponse\HTTPResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthRepo implements AuthRepoI
{
    use HTTPResponse;
    public function login(LoginRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('email',$request->get('email'))->first();
            if(!$user){
                return $this->error('User not found' , 401);
            }
            if (!Auth::attempt($request->only(['email' , 'password']))){
                return $this->error('Invalid Credentials' , 401);
            }
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            DB::commit();
            return $this->success([
                'user' => $user->hasRole(AppRoles::SUPER_ADMIN) ? SUserResource::make($user) : UserResource::make($user),
                'access_token' => $token,
            ]);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function logout()
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $user->currentAccessToken()->delete();
            DB::commit();
            return $this->success($user->hasRole(AppRoles::SUPER_ADMIN) ? SUserResource::make($user) : UserResource::make($user), 'good bey');
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError($th);
        }
    }
}
