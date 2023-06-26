<?php

namespace App\View\Components;

use App\Models\Material;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JsonLd\Context;
use JsonLd\ContextTypes\CreativeWork;
use JsonLd\ContextTypes\Person;

class JsonLd extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Material $material,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $context = Context::create(CreativeWork::class, [
            'description' => $this->material->description,
            'name' => $this->material->title,
            'url' => route('material.show', $this->material),
            'author' => new Person([
                'name' => $this->material->author,
            ]),
            'dateCreated' => $this->material->created_at,
            'dateModified' => $this->material->updated_at,
            'thumbnailUrl' => $this->material->image,
        ]);

        return view('components.json-ld')->with(compact('context'));
    }
}
