<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $materials = Material::keywordSearch($request->query('q'))
                             ->latest('id')
                             ->simplePaginate()
                             ->withQueryString();

        return view('material.index')->with(compact('materials'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material): View
    {
        abort_if(Storage::missing($material->file), 404);

        if ($material->filesize === 0) {
            $material->fill([
                'filesize' => Storage::size($material->file),
            ])->save();
        }

        return view('material.show')->with(compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @throws AuthorizationException
     */
    public function edit(Material $material): View
    {
        Gate::authorize('update', $material);

        return view('dashboard.edit')->with(compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Throwable
     */
    public function update(MaterialUpdateRequest $request, Material $material): RedirectResponse
    {
        Gate::authorize('update', $material);

        DB::transaction(function () use ($request, $material) {
            $title = $request->input('title');

            $material->fill([
                'title' => $title,
                'description' => $request->input('description'),
                'author' => Str::of($request->input('author'))->replace('/', '／')->replace('#', '＃')->value(),
            ])->save();

            $cats = Str::of($request->input('cat'))
                       ->replace('/', '／')
                       ->replace('#', '＃')
                       ->explode(',')
                       ->map(fn ($cat) => trim($cat))
                       ->unique()
                       ->reject(fn ($cat) => empty($cat))
                       ->map(fn ($cat) => Category::firstOrCreate([
                           'name' => $cat,
                       ]));

            $material->categories()->sync($cats->pluck('id'));
        });

        return to_route('material.show', $material);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Material $material): RedirectResponse
    {
        Gate::authorize('delete', $material);

        if ($request->boolean('forceDelete')) {
            Storage::delete($material->file);
            $material->forceDelete();
        } else {
            $material->delete();
        }

        return to_route('dashboard');
    }
}
