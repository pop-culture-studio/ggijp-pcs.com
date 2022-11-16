<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Category  $category
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Category $category)
    {
        $materials = $category->materials()
                              ->latest('id')
                              ->paginate();

        return view('category.show')->with(compact('category', 'materials'));
    }
}
