<?php

namespace Tests\Feature\Material;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_successful()
    {
        Storage::fake('materials');

        $file = UploadedFile::fake()->image('test.png');

        User::factory()->withPersonalTeam()->hasMaterials(1, [
            'title' => 'test',
            'author' => 'test',
            'file' => $file->path(),
        ])->create();

        $response = $this->get(route('material.index', ['q' => 'test']));

        $response->assertSuccessful()
                 ->assertSeeText('test');
    }

    public function test_search_dontsee()
    {
        Storage::fake('materials');

        $file = UploadedFile::fake()->image('test.png');

        User::factory()->withPersonalTeam()->hasMaterials(1, [
            'title' => 'test2',
            'author' => 'test2',
            'file' => $file->path(),
        ])->create();

        $response = $this->get(route('material.index', ['q' => 'aaaa']));

        $response->assertDontSeeText('test2');
    }
}
