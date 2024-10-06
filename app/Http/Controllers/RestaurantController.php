<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\CreateRestaurantTranslationRequest;
use App\Http\Requests\RenewRestaurantSubscriptionRequest;
use App\Http\Requests\ResetRestaurantPasswordRequest;
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

    public function show(int $id){
        return $this->restaurantService->show($id);
    }

    public function addTranslations($id , CreateRestaurantTranslationRequest $request){
        return $this->restaurantService->createTranslations($id , $request);
    }

    public function deleteRes(int $id)
    {
        return $this->restaurantService->deleteRes($id);
    }

    public function editRes(UpdateRestaurantRequest $request , int $id)
    {
        return $this->restaurantService->editRes($request , $id);
    }
    public function generateNewPassword(ResetRestaurantPasswordRequest $request , $id)
    {
        return $this->restaurantService->generateNewPassword($id , $request);
    }

    public function getAll()
    {
        return $this->restaurantService->getAll();
    }

    public function renewSubscription(RenewRestaurantSubscriptionRequest $request , int $id)
    {
        return $this->restaurantService->renewSubscription($id , $request);
    }

    public function stopRes(int $id)
    {
        return $this->restaurantService->stopRes($id);
    }

    public function updateLogoOrCover(UpdateRestaurantLogoRequest $request , int $id)
    {
        return $this->restaurantService->updateLogoOrCover($request , $id);
    }
}
