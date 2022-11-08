<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  string  $author
     * @return Application|Factory|View
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
