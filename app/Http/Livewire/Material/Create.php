<?php

namespace App\Http\Livewire\Material;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Material;

class Create extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $file;

    public $cat;

    public $title;

    public $description;

    public function updatedFile()
    {
        $this->validate([
            'file' => ['file', 'max:' . 1024 * config('pcs.max_upload'), 'mimes:' . config('pcs.mimes')],
        ]);
    }

    public function updatedCat()
    {
        $this->validate([
            'cat' => 'required',
        ], [
            'cat.required' => 'カテゴリーは必須です。'
        ]);
    }

    public function create()
    {
        $this->authorize('create', Material::class);

        $path = $this->file->store('materials/' . today()->year . '/' . today()->month);

        $title = $this->title ?? $this->file->getClientOriginalName();

        $cats = collect(explode(',', $this->cat))
            ->map(function ($cat) {
                return trim($cat);
            })
            ->unique()
            ->reject(function ($cat) {
                return empty($cat);
            })
            ->map(function ($cat) {
                return Category::firstOrCreate([
                    'name' => $cat,
                ]);
            });

        $material = request()->user()->materials()->create([
            'file' => $path,
            'title' => $title,
            'description' => $this->description
        ]);

        $material->categories()->sync($cats->pluck('id'));

        request()->session()->flash('flash.banner', $title . 'をアップロードしました。');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.material.create');
    }
}
