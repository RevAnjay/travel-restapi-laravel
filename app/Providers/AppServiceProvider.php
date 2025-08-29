<?php

namespace App\Providers;

use App\Repositories\DestinationRepository;
use App\Repositories\DestinationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            DestinationRepositoryInterface::class,
            DestinationRepository::class
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
