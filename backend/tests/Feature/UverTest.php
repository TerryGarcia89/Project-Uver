<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Notifications\LoginNeedsVerification;
use Illuminate\Support\Facades\Notification;

class UverTest extends TestCase
{
    public function it_can_create_a_user()
    {
        // Datos de prueba
        $data = [
            'name' => 'Test User',
            'phone' => '1234567890',
        ];

        // Crea un usuario
        $user = User::create($data);

        // Verifica que el usuario fue creado correctamente
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'phone' => '1234567890',
        ]);

        // Verifica que el usuario tenga los atributos esperados
        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('1234567890', $user->phone);
    }

    public function it_sends_verification_code()
    {
        Notification::fake();

        $response = $this->postJson('/login', [
            'phone' => '1234567890',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Código de verificación enviado.']);

        $user = User::first();
        $this->assertNotNull($user);
        $this->assertEquals('1234567890', $user->phone);

        Notification::assertSentTo(
            [$user], LoginNeedsVerification::class
        );
    }

    public function it_can_create_a_driver()
    {
        $user = User::factory()->create();

        $driverData = [
            'user_id' => $user->id,
            'year' => 2020,
            'make' => 'Toyota',
            'model' => 'Corolla',
            'color' => 'Blue',
            'license_plate' => 'ABC123',
        ];

        $driver = Driver::create($driverData);

        $this->assertDatabaseHas('drivers', [
            'user_id' => $user->id,
            'year' => 2020,
            'make' => 'Toyota',
            'model' => 'Corolla',
            'color' => 'Blue',
            'license_plate' => 'ABC123',
        ]);

        $this->assertEquals($user->id, $driver->user_id);
        $this->assertEquals(2020, $driver->year);
        $this->assertEquals('Toyota', $driver->make);
        $this->assertEquals('Corolla', $driver->model);
        $this->assertEquals('Blue', $driver->color);
        $this->assertEquals('ABC123', $driver->license_plate);
    }

}
