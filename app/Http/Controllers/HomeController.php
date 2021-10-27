<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Team;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $materials = Team::find(config('pcs.team_id'))
            ->materials()
            ->latest()
            ->limit(9)
            ->get();

        return view('home')->with(compact('materials'));
    }
}
