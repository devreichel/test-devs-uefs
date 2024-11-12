<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_tag()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/tags', ['name' => 'New Tag']);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', ['name' => 'New Tag']);
    }

    public function test_user_can_update_tag()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $tag = Tag::factory()->create();

        $response = $this->putJson("/api/tags/{$tag->id}", ['name' => 'Updated Tag']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tags', ['name' => 'Updated Tag']);
    }

    public function test_user_can_delete_tag()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $tag = Tag::factory()->create();

        $response = $this->deleteJson("/api/tags/{$tag->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}