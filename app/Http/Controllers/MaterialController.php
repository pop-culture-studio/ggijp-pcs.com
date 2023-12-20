<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);

        $this->authorizeResource(Material::class, 'material');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $materials = Material::keywordSearch($request->query('q'))
            //->select('id', 'file', 'title', 'thumbnail')
            ->latest('id')
            ->paginate()
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
     */
    public function edit(Material $material): View
    {
        return view('dashboard.edit')->with(compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Throwable
     */
    public function update(MaterialUpdateRequest $request, Material $material): RedirectResponse
    {
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
     */
    public function destroy(Request $request, Material $material): RedirectResponse
    {
        if ($request->boolean('forceDelete')) {
            Storage::delete($material->file);
            $material->forceDelete();
        } else {
            $material->delete();
        }

        return to_route('dashboard');
    }
}
