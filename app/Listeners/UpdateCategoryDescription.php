<?php

namespace App\Listeners;

use App\Events\MaterialUpdated;
use App\Jobs\ChatJob;
use App\Models\Category;

class UpdateCategoryDescription
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MaterialUpdated $event): void
    {
        $event->material
            ->categories
            ->each(fn (Category $category) => ChatJob::dispatch($category));
    }
}
