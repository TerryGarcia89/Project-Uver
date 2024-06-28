<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificationCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_verification_code_validation()
    {
        $user = User::factory()->create(['login_code' => '123456']);

        $response = $this->post('/verify-code', [
            'phone' => $user->phone,
            'code' => '123456'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Code verified successfully.']);
    }
}
