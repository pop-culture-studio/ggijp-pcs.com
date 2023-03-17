<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OpenAI\Laravel\Facades\OpenAI;

class ChatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Category $category)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->category->load('materials');
        $this->category->loadCount('materials');

//        foreach ($this->category->materials as $material) {
//            dump($material->title);
//        }

        $prompt = collect([
            $this->category->materials_count.'個のフリー素材がある「'.$this->category->name.'」カテゴリーのmeta descriptionを一つ',
            '素材例：'.$this->category->materials->pluck('title')->join(' '),
        ])->join(PHP_EOL);

        //dump($prompt);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        //        foreach ($response->choices as $result) {
        //            dump($result->message->content);
        //        }

        $result = head($response->choices);

        $this->category->forceFill([
            'description' => trim($result->message->content),
        ])->save();
    }
}
