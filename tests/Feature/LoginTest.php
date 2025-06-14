<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test] //Para comprobar que un usuario puede registrarse
    public function test_registro()
    {
        $response = $this->post('/validar-registro', [
            'name' => 'María',
            'surname' => 'Jiménez',
            'email' => 'mariaj@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('contenido'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'mariaj@example.com',
        ]);
    }

    #[Test] //Para comprobar el login
    public function test_iniciar_sesion()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/iniciar-sesion', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('contenido'));
        $this->assertAuthenticatedAs($user);
    }

    #[Test] //Para comprobar que un login incorrecto falla
    public function test_login_fallido()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/iniciar-sesion', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('fail');
        $this->assertGuest();
    }

    #[Test] //Para comprobar que se puede hacer logout
    public function test_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->post('/logout');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
