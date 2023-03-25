<?php

namespace Material;

use App\Models\Category;
use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $response = $this->get(route('material.index'));

        $response->assertSuccessful();
    }

    public function test_show()
    {
        Storage::fake();
        Storage::put('test.png', 'test');

        $m = Material::factory()->forUser()->create([
            'file' => 'test.png',
        ]);

        $response = $this->get(route('material.show', $m));

        $response->assertSuccessful();
    }

    public function test_edit()
    {
        Storage::fake();

        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $m = Material::factory()->for($user)->create();

        $response = $this->actingAs($user)
                         ->get(route('material.edit', $m));

        $response->assertSuccessful();
    }

    public function test_update()
    {
        Storage::fake();

        $user = User::factory()->withPersonalTeam()->create();

        $m = Material::factory()->for($user)->create();

        $response = $this->actingAs($user)
                         ->put(route('material.update', $m), [
                             'file' => UploadedFile::fake()->image('test.png'),
                             'title' => 'test',
                             'description' => 'test',
                             'author' => '#test/test',
                             'cat' => '#a, /b, c',
                         ]);

        $this->assertDatabaseHas('materials', [
            'title' => 'test',
            'description' => 'test',
            'author' => '＃test／test',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => '＃a',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => '／b',
        ]);

        $this->assertDatabaseCount('categories', 3);

        $response->assertRedirectToRoute('material.show', $m);
    }

    public function test_destroy()
    {
        $user = User::factory()->withPersonalTeam()->create();

        $m = Material::factory()->for($user)->create();

        $response = $this->actingAs($user)
                         ->delete(route('material.destroy', $m));

        $this->assertSoftDeleted($m);

        $this->assertDatabaseCount('materials', 1);

        $response->assertRedirectToRoute('dashboard');
    }

    public function test_destroy_force()
    {
        Storage::fake();

        $user = User::factory()->withPersonalTeam()->create();

        $m = Material::factory()->for($user)->create();

        $response = $this->actingAs($user)
                         ->delete(route('material.destroy', $m), [
                             'forceDelete' => true,
                         ]);

        $this->assertModelMissing($m);

        $this->assertDatabaseCount('materials', 0);

        $response->assertRedirectToRoute('dashboard');
    }
}
