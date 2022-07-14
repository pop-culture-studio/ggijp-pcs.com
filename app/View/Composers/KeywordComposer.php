<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class KeywordComposer
{
    /**
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $keywords = cache()->remember('keywords',
            now()->addHour(),
            fn () => Category::has('materials')
                             ->withCount('materials')
                             ->latest('materials_count')
                             ->get()
        );

        $view->with(compact('keywords'));
    }
}
