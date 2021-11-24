<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Material;
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
        $this->authorize('create', Material::class);

        $materials = Team::findOrFail(config('pcs.team_id'))
            ->materials()
            ->with(['categories', 'user'])
            ->latest('download')
            ->paginate();

        return view('dashboard.materials.index')->with(compact('materials'));
    }
}
