<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Team;

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
        View::composer('side', function ($view) {
            $cats = Category::has('materials')
                ->withCount(['materials' => function ($query) {
                    $query->whereIn('user_id', Team::find(config('pcs.team_id'))->allUsers()->pluck('id'));
                }])
                ->orderBy('name')
                ->get();

            $view->with(compact('cats'));
        });
    }
}
