<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Team;
use Illuminate\View\View;

class SideComposer
{
    /**
     * @param  \Illuminate\View\View  $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $cats = cache()->remember('side.cats',
            now()->addDay(),
            fn () => Category::has('materials')
                ->withCount('materials')
                ->orderBy('name')
                ->get()
        );

        $view->with(compact('cats'));
    }
}
