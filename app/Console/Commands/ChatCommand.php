<?php

namespace App\Console\Commands;

use App\Jobs\ChatJob;
use App\Models\Material;
use Illuminate\Console\Command;

class ChatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'material:chat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update material description by ChatGPT';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $material = Material::query()
                            ->select([
                                'id',
                                'title',
                                'description',
                                'created_at',
                                'author',
                            ])
                            ->whereNull('chat')
                            ->latest()
                            ->first();

        if (blank($material)) {
            return;
        }

        dump($material->toArray());

        ChatJob::dispatch($material);
    }
}
