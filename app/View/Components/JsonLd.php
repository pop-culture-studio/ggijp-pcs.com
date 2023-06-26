<?php

namespace App\View\Components;

use App\Models\Material;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JsonLd\Context;
use App\Support\JsonLd\ImageObject;
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
        $name = empty($this->material->author) ? config('app.name') : $this->material->author;

        $context = Context::create(ImageObject::class, [
            'creator' => new Person([
                'name' => $name,
            ]),
            'creditText' => config('app.name'),
            'contentUrl' => $this->material->image,
            'license' => route('terms.show'),
        ]);

        return view('components.json-ld')->with(compact('context'));
    }
}
