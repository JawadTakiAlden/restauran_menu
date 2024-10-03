<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\RenewRestaurantSubscriptionRequest;
use App\Http\Requests\UpdateRestaurantLogoRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Services\Restaurant\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function __construct(protected RestaurantService $restaurantService)
    {
    }

    public function createRes(CreateRestaurantRequest $request)
    {
        return $this->restaurantService->createRes($request);
    }

    public function deleteRes()
    {
        // TODO: Implement deleteRes() method.
    }

    public function editRes(UpdateRestaurantRequest $request)
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

    public function renewSubscription(RenewRestaurantSubscriptionRequest $request)
    {
        // TODO: Implement renewSubscription() method.
    }

    public function stopRes()
    {
        // TODO: Implement stopRes() method.
    }

    public function updateLogo(UpdateRestaurantLogoRequest $request)
    {
        // TODO: Implement updateLogo() method.
    }
}
