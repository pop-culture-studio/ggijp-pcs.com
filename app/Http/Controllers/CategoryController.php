<?php

namespace App\Http\Controllers;

use App\Jobs\ChatJob;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category): View
    {
        $materials = $category->materials()
                              ->latest('id')
                              ->paginate();

        if (blank($category->description)) {
            ChatJob::dispatch($category);
        }

        return view('category.show')->with(compact('category', 'materials'));
    }
}
