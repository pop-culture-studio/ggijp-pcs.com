<?php

namespace App\Providers;

use App\View\Composers\HomeComposer;
use App\View\Composers\KeywordComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home', HomeComposer::class);
        // View::composer('footer.category', KeywordComposer::class);
    }
}
