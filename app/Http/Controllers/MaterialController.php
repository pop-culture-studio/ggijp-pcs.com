<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialUpdateRequest;
use App\Models\Category;
use App\Models\Material;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $materials = Material::latest('id')
            ->when($request->query('search'), function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%$search%")
                        ->orWhere('description', 'LIKE', "%$search%");
                });
            })
            ->cursorPaginate()
            ->withQueryString();

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Material $material)
    {
        //Storage::delete($material->file);

        $material->delete();

        return redirect()->route('dashboard');
    }
}
