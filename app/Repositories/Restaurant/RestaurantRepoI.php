<?php

namespace App\Repositories\Restaurant;

use App\Http\Requests\CreateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantSubscription;
use App\Models\RestaurantTranslation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface RestaurantRepoI
{
    /**
     * Get all restaurants.
     *
     * @return Restaurant[] An array of Restaurant objects
     */
    public function getAll() : Collection;

    public function show(int $id) : ?Restaurant ;

    public function createRes(array $data) : Restaurant;

    public function createUserRestaurant(array $data) : User;

    public function createRestaurantSubscription(array $data) : RestaurantSubscription;

    public function editRes(array $data , Restaurant $restaurant) : Restaurant;

    public function updateLogoOrCover(array $data , Restaurant $restaurant) : Restaurant;

    public function generateNewPassword(string $password , Restaurant $restaurant);

    public function stopRes(Restaurant $restaurant) : bool;

    public function deleteRes(Restaurant $restaurant) : bool;

    public function createTranslation(array $data) : RestaurantTranslation;

    public function checkIfTranslationFound(int $restaurantId , string $lng) : bool;
}
