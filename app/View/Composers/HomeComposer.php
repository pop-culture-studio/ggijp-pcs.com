<?php

namespace App\View\Composers;

use App\Models\Material;
use Illuminate\View\View;

class HomeComposer
{
    public function compose(View $view): void
    {
        $popular_materials = Material::query()
            ->select()
            ->latest('download')
            ->limit(20)
            ->get();

        $new_materials = Material::query()
            ->select()
            ->latest('id')
            ->limit(20)
            ->get();

        $view->with(compact(
            'popular_materials',
            'new_materials'
        ));
    }
}
