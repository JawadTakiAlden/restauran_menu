<?php

namespace App\Repositories\Offer;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Collection;

class OfferRepo implements OfferRepoI
{
    public function getOfferOfRestaurant(int $restaurantId): Collection
    {
        return Offer::where('restaurant_id' , $restaurantId)->get();
    }

    public function create(array $data): Offer
    {
        return Offer::create($data);
    }

    public function show($offerId): Offer
    {
        return Offer::where('id' , $offerId)->first();
    }

    public function delete(Offer $offer)
    {
        $offer->delete();
    }
}
