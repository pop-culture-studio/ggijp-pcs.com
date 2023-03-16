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
    public function __construct(protected Material $material)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $prompt = collect([
            '次のフリー素材の説明文を作成',
            '',
            'タイトル：'.$this->material->title,
            '作者：'.$this->material->author,
            '説明：'.$this->material->description,
            '公開日：'.$this->material->created_at->toDateString(),
            //'メインカテゴリー：'.$this->material->categories->first()->name,
            'カテゴリー：'.$this->material->categories->map(fn (Category $cat) => $cat->name)->join(', '),
            'ファイルタイプ：'.cache('mimetype:'.$this->material->id),
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

        $this->material->forceFill([
            'chat' => trim($result->message->content),
        ])->save();
    }
}
