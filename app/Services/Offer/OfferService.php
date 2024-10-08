<?php

namespace App\Services\Offer;

use App\Http\Requests\CreateOfferRequest;
use App\Http\Resources\OfferResource;
use App\HttpResponse\HTTPResponse;
use App\Repositories\Offer\OfferRepoI;
use Illuminate\Support\Facades\DB;

class OfferService
{
    use HTTPResponse;
    public function __construct(protected OfferRepoI $offerRepo)
    {
    }

    public function getOfferOfRestaurant(int $restaurantId){
        try {
            $offers = $this->offerRepo->getOfferOfRestaurant($restaurantId);
            return $this->success(OfferResource::collection($offers));
        }catch(\Throwable $th){
            return $this->serverError();
        }
    }

    public function create(CreateOfferRequest $request){
        try {
            DB::beginTransaction();
            $this->offerRepo->create($request->only([
                'image'
            ]));
            DB::commit();
            return $this->success([
                'created' => true
            ]);
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function delete($offerId){
        try {
            DB::beginTransaction();
            $offer = $this->offerRepo->show($offerId);

            if (!$offer){
                return $this->error('offer not found' ,404);
            }

            $this->offerRepo->delete($offer);
            DB::commit();
            return $this->success([
                'deleted' => true,
                'offer_id' => $offer->id
            ]);
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }
}
