<?php

namespace App\Providers;

use Cart;
use App\Models\Genre;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.partials.nav', function ($view) {
            $view->with('genres', Genre::orderByRaw('-name ASC')->get()->nest());
        });
        View::composer('frontend.partials.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
    }
}
