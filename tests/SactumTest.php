<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class SactumTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            "email" => "pepe@pepe.es",
            "name" => "Pepe Garcia",
        ]);
        
        $response = $this->post("/api/login", [
            "email" => $user->email,
            "password" => "password"
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "user" => ["name", "email"],
            "token" => "token",
        ]);
    }

    public function test_user_can_see_auth_routes(): void
    {
        $user = User::factory()->create([
            "email" => "pepe@pepe.es",
            "name" => "Pepe Garcia",
        ]);
        
        $response = $this->post("/api/login", [
            "email" => $user->email,
            "password" => "password"
        ]);

        //fronted
        $token = $response->json("token");
        $response = $this
            ->withHeader("Authorization", "Bearer {$token}")
            ->get("/api/user");

        $response->assertJson([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
        ]);

    }

    public function test_user_can_create_post(): void
    {
        $user = User::factory()->create([
            "email" => "pepe@pepe.es",
            "name" => "Pepe Garcia",
        ]);

        Sanctum::actingAs($user, ['create-post']);
            
        $response = $this->getJson("/api/post/create", [
            "title" => "Mi título",
            "content" => "Mi contenido"
        ]);

        $response->assertStatus(200);

    }
}
