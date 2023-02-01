<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  string  $author
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request, string $author)
    {
        $materials = Material::query()
                             ->where('author', $author)
                             ->latest('id')
                             ->paginate();

        return view('author.show')->with(compact('author', 'materials'));
    }
}
