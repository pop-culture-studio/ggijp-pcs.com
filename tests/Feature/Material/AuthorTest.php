<?php

namespace Material;

use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_author()
    {
        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $author = Material::first();

        $response = $this->get(route('author', $author));

        $response->assertSuccessful()
                 ->assertViewHasAll(['author', 'materials']);
    }

    public function test_creator()
    {
        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $response = $this->get(route('creator', $user));

        $response->assertSuccessful()
                 ->assertViewHasAll(['user', 'materials']);
    }
}
