<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
        Model::shouldBeStrict(! $this->app->isProduction());

        //未来図倉庫チーム管理者
        Gate::define('admin', function (User $user) {
            return $user->hasTeamPermission(Team::find(config('pcs.team_id')), 'admin');
        });

        //未来図倉庫チームメンバー（管理者も含む）
        Gate::define('pcs', function (User $user) {
            return $user->belongsToTeam(Team::find(config('pcs.team_id')));
        });
    }
}
