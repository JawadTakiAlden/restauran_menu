<?php

namespace App\Services\Restaurant;

use App\AppRoles;
use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\CreateRestaurantTranslationRequest;
use App\Http\Requests\RenewRestaurantSubscriptionRequest;
use App\Http\Requests\ResetRestaurantPasswordRequest;
use App\Http\Requests\UpdateRestaurantLogoRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Resources\SuperAdmin\SRestaurantResource;
use App\HttpResponse\HTTPResponse;
use App\Models\Restaurant;
use App\Models\RestaurantSubscription;
use App\Models\RestaurantTranslation;
use App\Models\User;
use App\Repositories\Restaurant\RestaurantRepoI;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    use HTTPResponse;
    public function __construct(protected RestaurantRepoI $restaurantRepo)
    {
    }

    public function createRes(CreateRestaurantRequest $request)
    {
        try {
            $user = $this->restaurantRepo->createUserRestaurant($request->only(['username' , 'email' , 'password']));
            $user->assignRole(AppRoles::RESTAURANT);
            $restaurant = $this->restaurantRepo->createRes(
                array_merge(
                    $request->only(['name' , 'description'  ,'logo' , 'cover' , 'is_pending' , 'template_id' , 'is_offer_shown']),
                    [
                        "user_id" => $user->id
                    ]
                )
            );
            $this->restaurantRepo->createRestaurantSubscription([
                'restaurant_id' => $restaurant->id,
                'expiry_date' => $request->expiry_date,
                'price' => $request->price
            ]);
            DB::commit();
            return $this->success(SRestaurantResource::make($restaurant));
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError($th);
        }
    }

    public function createTranslations($id , CreateRestaurantTranslationRequest $request){
        try {
            DB::beginTransaction();
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            $translation_failed = collect([]);
            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->restaurantRepo->checkIfTranslationFound($restaurant->id , $translation['lng'])){
                        $translation_failed->push($translation['lng'] . "already added");
                    }
                    $this->restaurantRepo->createTranslation($translation);
                }
            }
            DB::commit();
            return $this->success([
                'translation_failed' => $translation_failed
            ]);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function deleteRes(int $id)
    {
        try {
            DB::beginTransaction();
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            $this->restaurantRepo->deleteRes($restaurant);
            DB::commit();
            return $this->success([
                'message' => 'deleted successfully'
            ]);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function show($id){
        try {
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            return $this->success(SRestaurantResource::make($restaurant));
        }catch(\Throwable $th){
            return $this->serverError();
        }
    }

    public function editRes(UpdateRestaurantRequest $request , int $id)
    {
        try {
            DB::beginTransaction();
            $res = $this->restaurantRepo->show($id);
            if (!$res){
                return $this->error('Restaurant not found' , 404);
            }
            $data = $request->only(['name', 'description', 'logo', 'cover', 'username', 'template_id', 'is_offer_shown', 'is_pending']);
            $restaurant = $this->restaurantRepo->editRes($data , $res);
            DB::commit();
            return $this->success(SRestaurantResource::make($restaurant));
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }

    }
    public function generateNewPassword(int $id , ResetRestaurantPasswordRequest $request)
    {
        try {
            DB::beginTransaction();
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            $this->restaurantRepo->generateNewPassword($request->password , $restaurant);
            DB::commit();
            return $this->success([
                'status' => true
            ]);
        }catch(\Throwable){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function getAll()
    {
        try {
            $restaurants = $this->restaurantRepo->getAll();
            return $this->success(SRestaurantResource::collection($restaurants));
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }

    }

    public function renewSubscription(int $id , RenewRestaurantSubscriptionRequest $request)
    {
        try {
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            $this->restaurantRepo->createRestaurantSubscription([
                'restaurant_id' => $restaurant->id,
                'expiry_date' => $request->expiry_date,
                'price' => $request->price
            ]);
            return $this->success(SRestaurantResource::make($restaurant));
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function stopRes(int $id)
    {
        try {
            DB::beginTransaction();
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            $newIsPendingStatus = $this->restaurantRepo->stopRes($restaurant);

            DB::commit();
            return $this->success([
                'is_pending' => $newIsPendingStatus
            ]);
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function updateLogoOrCover(UpdateRestaurantLogoRequest $request , int $id)
    {
        try {
            DB::beginTransaction();
            $restaurant = $this->restaurantRepo->show($id);
            if (!$restaurant){
                return $this->error('Restaurant not found' , 404);
            }
            $restaurant = $this->restaurantRepo->updateLogoOrCover($request->only(['logo' , 'cover']) , $restaurant);
            DB::commit();
            return $this->success(SRestaurantResource::make($restaurant));
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }
}
