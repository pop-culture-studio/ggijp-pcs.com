<?php

namespace Tests\Feature\Material;

use App\Http\Livewire\Material\Create;
use App\Models\Category;
use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        Storage::fake('materials');

        $file = UploadedFile::fake()->image('test.png');

        $this->actingAs(User::factory()->withPersonalTeam()->create());

        Livewire::test(Create::class)
            ->set('file', $file)
            ->set('cat', '1,2')
            ->set('title', null)
            ->set('description', 'test')
            ->call('create');

        $this->assertTrue(Material::whereTitle('test.png')->exists());
        $this->assertTrue(Material::whereDescription('test')->exists());
        $this->assertTrue(Category::whereName('2')->exists());
    }

    public function test_forbidden()
    {
        Livewire::test(Create::class)
            ->call('create')
            ->assertForbidden();
    }

    public function test_required_file()
    {
        $this->actingAs(User::factory()->withPersonalTeam()->create());

        Livewire::test(Create::class)
            ->set('file', null)
            ->set('cat', '1,2')
            ->set('title', 'foo')
            ->call('create')
            ->assertHasErrors(['file' => 'required']);
    }

    public function test_required_cat()
    {
        Storage::fake('materials');

        $file = UploadedFile::fake()->image('test.png');

        $this->actingAs(User::factory()->withPersonalTeam()->create());

        Livewire::test(Create::class)
            ->set('file', $file)
            ->set('cat', null)
            ->set('title', 'foo')
            ->call('create')
            ->assertHasErrors(['cat' => 'required']);
    }
}
