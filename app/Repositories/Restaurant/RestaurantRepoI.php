<?php

namespace App\Repositories\Restaurant;

use App\Http\Requests\CreateRestaurantRequest;

interface RestaurantRepoI
{
    public function getAll();

    public function createRes(CreateRestaurantRequest $request);

    public function editRes();

    public function updateLogo();

    public function generateNewPassword();

    public function stopRes();

    public function deleteRes();

    public function renewSubscription();
}
