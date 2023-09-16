<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Interfaces\SentenceServiceInterface;
use App\Providers\DailySentenceService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DailySentenceServiceInterface::class, DailySentenceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
