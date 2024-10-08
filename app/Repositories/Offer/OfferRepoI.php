<?php

namespace App\Repositories\Offer;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Collection;

interface OfferRepoI
{
    public function getOfferOfRestaurant(int $restaurantId) : Collection;


    public function create(array $data) : Offer;

    public function show($offerId) : Offer;

    public function delete(Offer $offer);
}
