<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class MaterialsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(Request $request): View
    {
        Gate::authorize('pcs');

        $materials = Material::query()
            ->latest('id')
            ->simplePaginate();

        return view('dashboard.materials.index')->with(compact('materials'));
    }
}
