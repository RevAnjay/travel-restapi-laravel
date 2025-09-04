<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\DestinationRepository;
use App\Repositories\DestinationRepositoryInterface;
use App\Repositories\PackageRepository;
use App\Repositories\PackageRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Destination
        $this->app->bind(
            DestinationRepositoryInterface::class,
            DestinationRepository::class
        );

        // Package
        $this->app->bind(
            PackageRepositoryInterface::class,
            PackageRepository::class
        );

        // Booking
        $this->app->bind(
            BookingRepositoryInterface::class,
            BookingRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
