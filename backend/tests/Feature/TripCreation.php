<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_trip()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/trips', [
            'origin' => ['lat' => 40.7128, 'lng' => -74.0060],
            'destination' => ['lat' => 34.0522, 'lng' => -118.2437],
            'destination_name' => 'Los Angeles'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('trips', [
            'user_id' => $user->id,
            'origin' => json_encode(['lat' => 40.7128, 'lng' => -74.0060]),
            'destination' => json_encode(['lat' => 34.0522, 'lng' => -118.2437]),
            'destination_name' => 'Los Angeles'
        ]);
    }
}
