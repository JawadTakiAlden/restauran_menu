<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferRequest;
use App\Models\Offer;
use App\Services\Offer\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct(protected OfferService $offerService)
    {
    }

    public function getByRestaurant(int $restaurantId){
        return $this->offerService->getOfferOfRestaurant($restaurantId);
    }
    public function create(CreateOfferRequest $request){
        return $this->offerService->create($request);
    }

    public function delete($offerId){
        return $this->offerService->delete($offerId);
    }
}
