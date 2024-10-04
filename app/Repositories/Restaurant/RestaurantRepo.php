<?php

namespace App\Repositories\Restaurant;

use App\AppRoles;
use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Resources\SuperAdmin\SRestaurantResource;
use App\HttpResponse\HTTPResponse;
use App\Models\Restaurant;
use App\Models\RestaurantSubscription;
use App\Models\RestaurantTranslation;
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
            $restaurantTranslations = $request->restaurant_translations;
            $restaurant = Restaurant::create(
                array_merge(
                    $request->only(['name' , 'description'  ,'logo' , 'cover' , 'is_pending' , 'template_id' , 'is_offer_shown']),
                    [
                        "user_id" => $user->id
                    ]
                )
            );
            if ($restaurantTranslations){
                foreach ($restaurantTranslations as $restaurantTranslation){
                    RestaurantTranslation::create(
                        array_merge(
                            $restaurantTranslation ,
                            ['restaurant_id' => $restaurant->id]
                        )
                    );
                }
            }
            RestaurantSubscription::create([
               'restaurant_id' => $restaurant->id,
               'expiry_date' => $request->expiry_date,
               'price' => $request->price
            ]);
            DB::commit();
            return $this->success(SRestaurantResource::make($restaurant));
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
