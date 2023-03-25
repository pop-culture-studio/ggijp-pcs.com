<?php

namespace Material;

use App\Models\Category;
use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_download()
    {
        Bus::fake();
        Storage::fake();

        $material = Material::factory()->forUser()->create([
            'file' => 'test.png',
        ]);

        $response = $this->withoutMiddleware()
                         ->get(route('download', $material));

        $response->assertRedirect();
    }
}
