<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Tour;
use App\Models\Review;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\TourCategory\CatTourRepositoryInterface::class,
            \App\Repositories\TourCategory\CatTourRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Tour\TourRepositoryInterface::class,
            \App\Repositories\Tour\TourRepository::class
        );
        $this->app->singleton(
            \App\Repositories\BookingTour\BookingRepositoryInterface::class,
            \App\Repositories\BookingTour\BookingRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Relation::morphMap([
            'users' => User::class,
            'reviews' => Review::class,
            'tours' => Tour::class
        ]);
    }
}
