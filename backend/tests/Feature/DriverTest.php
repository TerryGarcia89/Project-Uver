<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_becomes_driver()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/driver/update', [
            'year' => 2022,
            'make' => 'Toyota',
            'model' => 'Camry',
            'color' => 'Blue',
            'license_plate' => 'XYZ123',
            'name' => 'John Doe'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('drivers', [
            'user_id' => $user->id,
            'year' => 2022,
            'make' => 'Toyota',
            'model' => 'Camry',
            'color' => 'Blue',
            'license_plate' => 'XYZ123'
        ]);
    }
}
