<?php

namespace Material;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_feed_rss()
    {
        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $response = $this->get('/feed/rss');

        $response->assertStatus(200);
    }

    public function test_feed_json()
    {
        $user = User::factory()->withPersonalTeam()->withMaterials()->create();

        $response = $this->get('/feed/json');

        $response->assertStatus(200);
    }
}
