<?php

namespace App\Repositories\Restaurant;

use App\AppRoles;
use App\Http\Requests\CreateRestaurantRequest;
use App\HttpResponse\HTTPResponse;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RestaurantRepo implements RestaurantRepoI
{
    use HTTPResponse;
    public function createRes(CreateRestaurantRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create($request->only(['username' , 'email' , 'password']));
            $user->assignRole(AppRoles::RESTAURANT);
            $restaurant = Restaurant::create(
                array_merge(
                    $request->only(['name' , 'description'  ,'logo' , 'cover' , 'is_pending' , 'template_id' , 'is_offer_shown']),
                    [
                        "user_id" => $user->id
                    ]
                )
            );
//            TODO :: Create Restaurant Subscription record and restaurant resources to return data
            DB::commit();
            return $this->success(null);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function deleteRes()
    {
        // TODO: Implement deleteRes() method.
    }

    public function editRes()
    {
        // TODO: Implement editRes() method.
    }
    public function generateNewPassword()
    {
        // TODO: Implement generateNewPassword() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function renewSubscription()
    {
        // TODO: Implement renewSubscription() method.
    }

    public function stopRes()
    {
        // TODO: Implement stopRes() method.
    }

    public function updateLogo()
    {
        // TODO: Implement updateLogo() method.
    }
}
