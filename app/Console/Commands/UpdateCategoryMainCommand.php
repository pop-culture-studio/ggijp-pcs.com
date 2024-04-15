<?php

namespace App\Console\Commands;

use App\Jobs\ChatJob;
use App\Models\Category;
use Illuminate\Console\Command;

class UpdateCategoryMainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cat:main';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update main category description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $ids = collect(config('pcs.category'))->pluck('title')->values()->toArray();

        $category = Category::query()
            ->whereIn('name', $ids)
            ->oldest('updated_at')
            ->first();

        //dump($category);

        if (blank($category)) {
            return;
        }

        dump($category->toArray());

        ChatJob::dispatch($category);
    }
}
