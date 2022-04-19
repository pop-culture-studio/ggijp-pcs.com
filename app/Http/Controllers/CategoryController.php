<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return to_route('home');
    }

    public function show(Category $category)
    {
        $materials = $category->materials()
                              ->latest('id')
                              ->cursorPaginate();

        return view('category.show')->with(compact('category', 'materials'));
    }
}
