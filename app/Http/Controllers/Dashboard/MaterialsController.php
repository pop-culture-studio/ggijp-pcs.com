<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(Request $request): View
    {
        $this->authorize('pcs');

        $materials = Material::query()
                             ->latest('id')
                             ->paginate();

        return view('dashboard.materials.index')->with(compact('materials'));
    }
}
