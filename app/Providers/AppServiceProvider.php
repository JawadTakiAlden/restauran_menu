<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepo;
use App\Repositories\Auth\AuthRepoI;
use App\Repositories\Category\CategoryRepo;
use App\Repositories\Category\CategoryRepoI;
use App\Repositories\Offer\OfferRepo;
use App\Repositories\Offer\OfferRepoI;
use App\Repositories\Product\ProductRepo;
use App\Repositories\Product\ProductRepoI;
use App\Repositories\Restaurant\RestaurantRepo;
use App\Repositories\Restaurant\RestaurantRepoI;
use App\Repositories\Template\TemplateRepo;
use App\Repositories\Template\TemplateRepoI;
use App\Repositories\User\UserRepo;
use App\Repositories\User\UserRepoI;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepoI::class, AuthRepo::class);
        $this->app->bind(UserRepoI::class, UserRepo::class);
        $this->app->bind(RestaurantRepoI::class, RestaurantRepo::class);
        $this->app->bind(CategoryRepoI::class, CategoryRepo::class);
        $this->app->bind(ProductRepoI::class, ProductRepo::class);
        $this->app->bind(TemplateRepoI::class, TemplateRepo::class);
        $this->app->bind(OfferRepoI::class, OfferRepo::class);
//        $this->app->bind(AuthService::class, function ($app) {
//            return new AuthService($app->make(AuthRepoI::class));
//        });
//        $this->app->bind(UserService::class, function ($app) {
//            return new UserService($app->make(UserRepoI::class));
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
