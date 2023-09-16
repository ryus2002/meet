<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DailySentenceService extends ServiceProvider
{
    /**
     * @return string Return the result of the URL
     */
    public function getSentence() {
        $url = 'http://metaphorpsum.com/sentences/3';
    }
    // /**
    //  * Register services.
    //  */
    // public function register(): void
    // {
    //     //
    // }

    // /**
    //  * Bootstrap services.
    //  */
    // public function boot(): void
    // {
    //     //
    // }
}
