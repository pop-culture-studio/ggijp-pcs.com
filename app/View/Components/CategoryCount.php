<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryCount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name,
        public int $count = 0,
    ) {
        $this->count = cache()->remember(
            key: 'category.count:'.$this->name,
            ttl: now()->addHours(12),
            callback: fn () => Category::withCount('materials')
                                       ->whereName($this->name)
                                       ->first()->materials_count ?? 0
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-count');
    }
}
