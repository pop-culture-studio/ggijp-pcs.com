<?php

namespace App\Http\Livewire\Material;

use App\Jobs\ChatJob;
use App\Models\Material;
use Illuminate\View\View;
use Livewire\Component;

class UpdateChat extends Component
{
    public Material $material;

    public function update(): void
    {
        ChatJob::dispatch($this->material);

        session()->flash('message', 'ChatGPTによる説明を更新中。少し待ってからリロードしてください。');
    }

    public function render(): View
    {
        return view('livewire.material.update-chat');
    }
}
