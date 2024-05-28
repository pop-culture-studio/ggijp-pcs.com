<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request, string $author): View
    {
        // folioを使うと$authorがURLエンコードされた文字列になるのでコントローラーの使用を継続

        $materials = Material::query()
            ->where('author', $author)
            ->latest('id')
            ->paginate();

        return view('author.show')->with(compact('author', 'materials'));
    }
}
