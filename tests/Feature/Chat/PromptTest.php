<?php

namespace Tests\Feature\Chat;

use App\Chat\Prompt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class PromptTest extends TestCase
{
    public function test_prompt(): void
    {
        $prompt = Prompt::make('system', 'user')
                        ->withModel('test')
                        ->withMaxTokens(100)
                        ->withTemperature(1.0);

        $this->assertIsArray($prompt->toArray());
        $this->assertSame([['role' => 'system', 'content' => 'system'], ['role' => 'user', 'content' => 'user']],
            Arr::get($prompt->toArray(), 'messages'));
    }

    public function test_prompt_with_images(): void
    {
        $prompt = Prompt::make('system', 'user')
                        ->withImage('url1')
                        ->withImage('url2');

        $this->assertSame(['type' => 'image_url', 'image_url' => ['url' => 'url1']],
            Arr::get($prompt->toArray(), 'messages.1.content.1'));
    }
}
