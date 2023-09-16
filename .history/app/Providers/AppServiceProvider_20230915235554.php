<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Interfaces\DailySentenceServiceInterface;
use App\Services\DailySentenceService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}