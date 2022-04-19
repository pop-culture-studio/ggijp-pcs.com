<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, User $user)
    {
        $materials = $user->materials()
                          ->latest('id')
                          ->cursorPaginate();

        return view('creator.show')->with(compact('user', 'materials'));
    }
}
