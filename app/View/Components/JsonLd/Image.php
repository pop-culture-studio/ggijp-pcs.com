<?php

namespace App\View\Components\JsonLd;

use App\Models\Material;
use App\Support\JsonLd\ImageObject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JsonLd\Context;

class Image extends Component
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
            'creator' => [
                'name' => $name,
            ],
            'creditText' => config('app.name'),
            'contentUrl' => $this->material->image,
            'license' => route('terms.show'),
            'acquireLicensePage' => route('terms.show'),
            'copyrightNotice' => $name,
        ]);

        return view('components.json-ld.image')->with(compact('context'));
    }
}
