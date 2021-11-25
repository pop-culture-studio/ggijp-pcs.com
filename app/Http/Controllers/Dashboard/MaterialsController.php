<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

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

        $materials = Material::with(['categories', 'user'])
            ->latest('download')
            ->paginate();

        return view('dashboard.materials.index')->with(compact('materials'));
    }
}
