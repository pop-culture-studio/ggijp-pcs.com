<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Material $material)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('pcs');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Material $material)
    {
        return $material->user->is($user) ||
            $user->hasTeamPermission(Team::find(config('pcs.team_id')), 'admin:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Material $material)
    {
        return $material->user->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Material $material)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Material $material)
    {
        //
    }
}
