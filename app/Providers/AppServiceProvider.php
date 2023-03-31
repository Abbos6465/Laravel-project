<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFour();

        view()->composer('components.navbar', function ($view) {
            $view->with('current_locale', App::currentLocale());
            $view->with('all_locales', config('app.all_locales'));
        });
    }
}
