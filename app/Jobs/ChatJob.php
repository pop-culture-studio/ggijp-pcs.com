<?php

namespace App\Jobs;

use App\Chat\Prompt;
use App\Models\Category;
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

    protected const MODEL = 'gpt-4-turbo';

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
        if (blank(config('openai.api_key'))) {
            return;
        }

        $this->category->load('materials');
        $this->category->loadCount('materials');

        $prompt = collect([
            $this->category->materials_count.'個のフリー素材がある「'.$this->category->name.'」カテゴリーのmeta descriptionを一つ作成。',
            'カテゴリー内の素材例：'.$this->category->materials()->latest()->take(10)->pluck('title')->join(' '),
        ])->join(PHP_EOL);

        info($prompt);

        $response = OpenAI::chat()->create(
            Prompt::make(
                system: 'あなたはフリー素材サイトの運営者です',
                prompt: $prompt
            )->toArray()
        );

        foreach ($response->choices as $result) {
            info($result->message->content);
        }

        $result = head($response->choices);

        $this->category->forceFill([
            'description' => trim($result->message->content),
        ])->save();
    }
}
