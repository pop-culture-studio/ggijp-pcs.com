<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('create', Material::class);

        $materials = Material::query()
                             ->latest('download')
                             ->paginate();

        return view('dashboard.materials.index')->with(compact('materials'));
    }
}
