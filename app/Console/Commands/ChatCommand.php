<?php

namespace App\Console\Commands;

use App\Jobs\ChatJob;
use App\Models\Category;
use Illuminate\Console\Command;

class ChatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chatgpt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update category description by ChatGPT';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //$ids = collect(config('pcs.category'))->pluck('id')->values()->toArray();

        $category = Category::query()
                            //->whereIntegerInRaw('id', $ids)
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
