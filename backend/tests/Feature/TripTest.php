<?php

namespace Tests\Feature;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_has_user_as_client()
    {
        $user = User::factory()->create();
        $driver = Driver::factory()->create(['user_id' => $user->id]);
        $trip = Trip::factory()->create(['user_id' => $user->id, 'driver_id' => $driver->id]);

        $this->assertEquals($user->id, $trip->user->id);
        $this->assertEquals($driver->id, $trip->driver->id);
    }
}
