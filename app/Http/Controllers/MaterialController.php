<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);

        $this->authorizeResource(Material::class, 'material');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $materials = Material::latest('id')
            ->when($request->query('search'), $this->search(...))
            ->cursorPaginate()
            ->withQueryString();

        return view('material.index')->with(compact('materials'));
    }

    /**
     * @param  Builder  $query
     * @param $search
     * @return Builder
     */
    protected function search(Builder $query, $search): Builder
    {
        return $query->where(function (Builder $query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhereHas('categories', function (Builder $query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })->orWhereHas('user', function (Builder $query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     *
     * @return Application|Factory|View
     */
    public function show(Material $material)
    {
        abort_if(Storage::missing($material->file), 404);

        return view('material.show')->with(compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     *
     * @return Application|Factory|View
     */
    public function edit(Material $material)
    {
        return view('material.edit')->with(compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     *
     * @return RedirectResponse
     */
    public function update(MaterialUpdateRequest $request, Material $material)
    {
        DB::transaction(function () use ($request, $material) {
            $title = $request->input('title');

            $material->fill([
                'title' => $title,
                'description' => $request->input('description'),
            ])->save();

            $cats = Str::of($request->input('cat'))
                ->explode(',')
                ->map(fn ($cat) => trim($cat))
                ->unique()
                ->reject(fn ($cat) => empty($cat))
                ->map(fn ($cat) => Category::firstOrCreate([
                    'name' => $cat,
                ]));

            $material->categories()->sync($cats->pluck('id'));
        });

        return redirect()->route('material.show', $material);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     *
     * @return RedirectResponse
     */
    public function destroy(Material $material)
    {
        //Storage::delete($material->file);

        $material->delete();

        return redirect()->route('dashboard');
    }
}
