<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $materials = Material::latest('id')
                             ->limit(10)
                             ->get();

        return view('home')->with(compact('materials'));
    }
}
