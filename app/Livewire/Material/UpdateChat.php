<?php

namespace App\Livewire\Material;

use App\Jobs\ChatJob;
use App\Models\Category;
use Livewire\Component;

class UpdateChat extends Component
{
    public Category $category;

    public function update(): void
    {
        ChatJob::dispatch($this->category);

        session()->flash('message', 'ChatGPTによる説明を更新中。少し待ってからリロードしてください。');
    }
}
