<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $materials = Material::latest()
            ->limit(10)
            ->get();

        return view('home')->with(compact('materials'));
    }
}
