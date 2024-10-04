<?php

namespace App\Services\Restaurant;

use App\Http\Requests\CreateRestaurantRequest;
use App\Repositories\Restaurant\RestaurantRepoI;

class RestaurantService
{
    public function __construct(protected RestaurantRepoI $restaurantRepo)
    {
    }

    public function createRes(CreateRestaurantRequest $request)
    {
        return $this->restaurantRepo->createRes($request);
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
        return $this->restaurantRepo->getAll();
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
