<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $materials = $request->user()
            ->materials()
            ->withTrashed()
            ->latest()
            ->cursorPaginate(5);

        return view('dashboard')->with(compact('materials'));
    }
}
