<?php

use function Laravel\Folio\name;
use function Laravel\Folio\render;

name('sitemap');

render(
    fn () => response(Storage::get('sitemap.xml'), 200, [
        'Content-Type' => 'application/xml; charset="UTF-8"',
    ])
);
