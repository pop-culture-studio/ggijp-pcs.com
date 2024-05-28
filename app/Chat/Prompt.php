<?php

declare(strict_types=1);

namespace App\Chat;

use Closure;
use Illuminate\Contracts\Support\Arrayable;

class Prompt implements Arrayable
{
    protected string $model = 'gpt-4o';
    protected int $max_tokens = 1000;
    protected float $temperature = 1.0;

    protected array $images = [];

    public function __construct(
        protected readonly string $system,
        protected readonly string|Closure $prompt,
    ) {
    }

    public static function make(
        string $system,
        string|Closure $prompt,
    ): static {
        return new static(system: $system, prompt: $prompt);
    }

    public function withModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function withMaxTokens(int $max_tokens): static
    {
        $this->max_tokens = $max_tokens;

        return $this;
    }

    public function withTemperature(float $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function withImage(string $url): static
    {
        $this->images[] = [
            'type' => 'image_url',
            'image_url' => [
                'url' => $url,
            ],
        ];

        return $this;
    }

    private function prompt()
    {
        return is_callable($this->prompt) ? call_user_func($this->prompt) : $this->prompt;
    }

    /**
     * @return array{
     *     model: string,
     *     max_tokens: int,
     *     temperature: float,
     *     messages: array{
     *         0: array{role: string, content: string},
     *         1: array{role: string, content: string}
     *     }
     * }
     */
    public function toArray(): array
    {
        if (blank($this->images)) {
            $content = $this->prompt();
        } else {
            $content = collect([
                [
                    'type' => 'text',
                    'text' => $this->prompt(),
                ],
            ])->merge($this->images)
              ->toArray();
        }

        return [
            'model' => $this->model,
            'max_tokens' => $this->max_tokens,
            'temperature' => $this->temperature,
            'messages' => [
                ['role' => 'system', 'content' => $this->system],
                [
                    'role' => 'user',
                    'content' => $content,
                ],
            ],
        ];
    }
}
