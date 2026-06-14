<?php

namespace App\Providers;

use App\Models\CheckinCheckout;
use App\Observers\CheckinCheckoutObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        CheckinCheckout::observe(CheckinCheckoutObserver::class);
    }
}