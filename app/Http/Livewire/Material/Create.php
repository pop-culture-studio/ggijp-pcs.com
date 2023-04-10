<?php

namespace App\Http\Livewire\Material;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public string|TemporaryUploadedFile|null $file = null;

    public ?string $cat = null;

    public ?string $title = null;

    public ?string $description = null;

    public ?string $author = null;

    protected function rules(): array
    {
        return [
            'file' => ['file', 'required', 'max:'. 1024 * config('pcs.max_upload')],
            'cat' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'cat.required' => 'カテゴリーは必須です。',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function create(): RedirectResponse
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
                'author' => Str::of($this->author)->replace('/', '／')->replace('#', '＃')->value(),
            ]);

            $cats = Str::of($this->cat)
                       ->replace('/', '／')
                       ->replace('#', '＃')
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

    public function render(): View
    {
        return view('livewire.material.create');
    }
}
