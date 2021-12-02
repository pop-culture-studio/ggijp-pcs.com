<?php

namespace App\Http\Livewire\Material;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public string|TemporaryUploadedFile|null $file = null;

    public ?string $cat = null;

    public ?string $title = null;

    public ?string $description = null;

    protected function rules()
    {
        return [
            'file' => ['file', 'required', 'max:'. 1024 * config('pcs.max_upload')],
            'cat' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'cat.required' => 'カテゴリーは必須です。',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->authorize('create', Material::class);

        $this->validate();

        DB::transaction(function () {
            $store_path = 'materials/'.today()->year.'/'.today()->month;

            $path = match (true) {
                // vrmファイルは正しく認識されないので拡張子を指定して保存。
                $this->file->getMimeType() === 'model/vrml' => $this->file->storeAs($store_path,
                    Str::random(40).'.vrm'),

                default => $this->file->store($store_path),
            };

            $title = $this->title ?? $this->file->getClientOriginalName();

            $material = request()->user()->materials()->create([
                'file' => $path,
                'title' => $title,
                'description' => $this->description,
            ]);

            $cats = Str::of($this->cat)
                ->explode(',')
                ->map(fn ($cat) => trim($cat))
                ->unique()
                ->reject(fn ($cat) => empty($cat))
                ->map(fn ($cat) => Category::firstOrCreate([
                    'name' => $cat,
                ]));

            $material->categories()->sync($cats->pluck('id'));

            session()->flash('flash.banner', $title.'をアップロードしました。');
        });

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.material.create');
    }
}
