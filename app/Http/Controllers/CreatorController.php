<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreatorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user): View
    {
        $materials = $user->materials()
            ->latest('id')
            ->paginate();

        return view('creator.show')->with(compact('user', 'materials'));
    }
}
