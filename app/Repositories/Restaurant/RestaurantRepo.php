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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RestaurantRepo implements RestaurantRepoI
{
    use HTTPResponse;
    public function createRes(array $data) : Restaurant
    {
        $restaurant = Restaurant::create($data);
        return $restaurant;
    }
    public function show(int $id): Restaurant
    {
        $restaurant = Restaurant::where('id' , $id);
        return $restaurant;
    }
    public function createUserRestaurant(array $data) : User
    {
        $user = User::create($data);
        return $user;
    }
    public function createRestaurantSubscription(array $data) : RestaurantSubscription
    {
        $subscriotion = RestaurantSubscription::create($data);
        return $subscriotion;
    }
    public function deleteRes(Restaurant $restaurant) : bool
    {
        $restaurant->delete();
        return true;
    }

    public function createTranslation(array $data) : RestaurantTranslation{
        $translation = RestaurantTranslation::create($data);
        return $translation;
    }

    public function checkIfTranslationFound(int $restaurantId , string $lng) : bool{
        return RestaurantTranslation::where(['restaurant_id' => $restaurantId , 'lng' => $lng])->exists();
    }
    public function editRes(array $data , Restaurant $restaurant) : Restaurant
    {
        $restaurant->update($data);
        return $restaurant;
    }
    public function generateNewPassword(string $password , Restaurant $restaurant)
    {
        $restaurant->update([
           'password' => $password
        ]);
    }
    public function getAll() : Collection
    {
       return Restaurant::all();
    }
    public function stopRes(Restaurant $restaurant) : bool
    {
        $is_pending = !$restaurant->is_pending;
        $restaurant->update([
           'is_pending' => $is_pending
        ]);
        return $is_pending;
    }
    public function updateLogoOrCover(array $data , Restaurant $restaurant) : Restaurant
    {
        $restaurant->update($data);
        return $restaurant;
    }
}
