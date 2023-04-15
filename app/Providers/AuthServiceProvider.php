<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        //未来図倉庫チーム管理者
        Gate::define('admin', function (User $user) {
            return $user->hasTeamPermission(Team::find(config('pcs.team_id')), 'admin');
        });

        //未来図倉庫チームメンバー
        Gate::define('pcs', function (User $user) {
            return $user->belongsToTeam(Team::find(config('pcs.team_id')));
        });
    }
}
