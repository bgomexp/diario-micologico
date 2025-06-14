<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test] //Para comprobar que un usuario puede acceder a la página de su cuenta
    public function test_acceso_cuenta()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/cuenta/{$user->id}");
        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }

    #[Test] //Para comprobar que un usuario no puede acceder a la página de cuenta de otro
    public function test_acceso_otra_cuenta()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1)->get("/cuenta/{$user2->id}");
        $response->assertRedirect(route('contenido'));
        $response->assertSessionHas('fail');
    }

    #[Test] //Para comprobar que un usuario puede actualizar sus datos
    public function test_actualizar_datos()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('users.updatedata'), [
            'name' => 'Nuevo Nombre',
            'surname' => 'Nuevo Apellido',
            'email' => 'nuevo@example.com',
        ]);

        $response->assertViewIs('users.edit');
        $this->assertDatabaseHas('users', [
            'name' => 'Nuevo Nombre',
            'surname' => 'Nuevo Apellido',
            'email' => 'nuevo@example.com',
        ]);
    }

    #[Test] //Para comprobar que un usuario puede cambiar su contraseña
    public function test_cambio_contrasenia()
    {
        $user = User::factory()->create([
            'password' => Hash::make('passwordvieja'),
        ]);

        $response = $this->actingAs($user)->put(route('users.updatepassword'), [
            'old_password' => 'passwordvieja',
            'password' => 'passwordnueva',
            'password_confirmation' => 'passwordnueva',
        ]);

        $response->assertViewIs('users.edit');
        $this->assertTrue(Hash::check('passwordnueva', $user->fresh()->password));
    }

    #[Test] //Para comprobar que si se introduce mal la contraseña antigua, no se actualiza
    public function test_cambio_contrasenia_incorrecto()
    {
        $user = User::factory()->create([
            'password' => Hash::make('passwordvieja'),
        ]);

        $response = $this->actingAs($user)->put(route('users.updatepassword'), [
            'old_password' => 'incorrecta',
            'password' => 'passwordnueva',
            'password_confirmation' => 'passwordnueva',
        ]);

        $response->assertViewIs('users.edit');
        $response->assertSessionHas('fail');
        $this->assertTrue(Hash::check('passwordvieja', $user->fresh()->password));
    }

    #[Test] //Para comprobar que un usuario puede eliminar su cuenta
    public function test_eliminar_cuenta()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('users.destroy'));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
