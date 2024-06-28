<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'phone' => '1234567890'
        ]);
    }
}
