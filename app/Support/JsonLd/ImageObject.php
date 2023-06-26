<?php

namespace App\Support\JsonLd;

use JsonLd\ContextTypes\AbstractContext;
use JsonLd\ContextTypes\Person;

class ImageObject extends AbstractContext
{
    /**
     * Property structure
     *
     * @var array
     */
    protected $structure = [
        'creator' => Person::class,
        'creditText' => null,
        'license' => null,
        'contentUrl' => null,
    ];
}
