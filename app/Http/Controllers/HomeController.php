<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $popular_materials = Material::latest('download')
                                     ->limit(10)
                                     ->get();

        $new_materials = Material::latest('id')
                                 ->limit(10)
                                 ->get();

        return view('home')->with(compact(
            'popular_materials',
            'new_materials'
        ));
    }
}
