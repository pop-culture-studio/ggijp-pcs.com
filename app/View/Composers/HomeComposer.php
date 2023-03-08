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
    public function compose(View $view): void
    {
        $popular_materials = cache()->remember('home.popular', now()->addHour(), function () {
            return Material::query()
                           ->select('id')
                           ->latest('download')
                           ->limit(20)
                           ->get();
        });

        $new_materials = cache()->remember('home.new', now()->addHour(), function () {
            return Material::query()
                           ->select('id')
                           ->latest('id')
                           ->limit(20)
                           ->get();
        });

        $view->with(compact(
            'popular_materials',
            'new_materials'
        ));
    }
}
