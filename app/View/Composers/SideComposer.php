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
        $cats = Category::has('materials')
                        ->withCount([
                            'materials' => function ($query) {
                                $query->whereIn('user_id',
                                    Team::find(config('pcs.team_id'))?->allUsers()->pluck('id') ?? []);
                            },
                        ])
                        ->orderBy('name')
                        ->get();

        $view->with(compact('cats'));
    }
}
