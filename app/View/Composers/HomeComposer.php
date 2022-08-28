<?php

namespace App\View\Composers;

use App\Models\Material;
use Illuminate\View\View;

class HomeComposer
{
    /**
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $popular_materials = cache()->remember('home.popular',
            now()->addHour(),
            fn () => Material::with('categories')
                             ->latest('download')
                             ->limit(20)
                             ->get()
        );

        $new_materials = cache()->remember('home.new',
            now()->addHour(),
            fn () => Material::with('categories')
                             ->latest('id')
                             ->limit(20)
                             ->get()
        );

        $view->with(compact(
            'popular_materials',
            'new_materials'
        ));
    }
}
