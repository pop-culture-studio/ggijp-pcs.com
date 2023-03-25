<?php

namespace Material;

use App\Models\Category;
use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category()
    {
        Bus::fake();

        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $cat = Category::factory()->create();

        $material = Material::first();
        $material->categories()->attach($cat->id);

        $response = $this->get(route('category.show', $cat));

        $response->assertSuccessful()
                 ->assertViewHasAll([
                     'category' => $cat,
                     'materials'
                 ]);
    }
}
