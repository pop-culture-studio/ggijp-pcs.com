<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class MaterialsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $team = Team::find(config('pcs.team_id'));

        abort_unless($request->user()->belongsToTeam($team), 403);

        $materials = $team->materials()
            ->with(['categories', 'user'])
            ->latest('download')
            ->paginate();

        return view('dashboard.materials.index')->with(compact('materials'));
    }
}
