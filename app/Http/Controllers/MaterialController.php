<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Category;
use App\Models\Material;
use App\Models\Team;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Team::find(config('pcs.team_id'))
            ->materials()
            ->latest()
            ->cursorPaginate();

        return view('material.index')->with(compact('materials'));
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
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('material.show')->with(compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialUpdateRequest $request, Material $material)
    {
        $title = $request->input('title');

        $material->fill([
            'title' => $title,
            'description' => $request->input('description')
        ])->save();

        $cats = collect(explode(',', $request->input('cat')))
            ->map(function ($cat) {
                return trim($cat);
            })
            ->unique()
            ->reject(function ($cat) {
                return empty($cat);
            })
            ->map(function ($cat) {
                return Category::firstOrCreate([
                    'name' => $cat,
                ]);
            });

        $material->categories()->sync($cats->pluck('id'));

        return redirect()->route('material.show', $material)->banner($title . 'を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //Storage::delete($material->file);

        $material->delete();

        return redirect()->route('dashboard');
    }
}
