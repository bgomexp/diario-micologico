<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Especie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuggestionMail;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EspecieTest extends TestCase
{
    use RefreshDatabase;

    #[Test] //Para comprobar el listado de especies
    public function test_ver_listado_especies()
    {
        $user = User::factory()->create();
        $especies = Especie::factory()->count(3)->create();

        $response = $this->actingAs($user)->get('/especies');

        $response->assertStatus(200);
        $response->assertSee($especies[0]->genero);
    }

    #[Test] //Para comprobar que un usuario no autenticado no puede acceder al listado de especies
    public function test_no_autenticado_listado_especies()
    {
        $response = $this->get('/especies');
        $response->assertRedirect('/login');
    }

    #[Test] //Para comprobar la visualización de los detalles de una especie
    public function test_ver_detalles_especie()
    {
        $user = User::factory()->create();
        $especie = Especie::factory()->create();

        $response = $this->actingAs($user)->get("/especies/{$especie->id}");
        $response->assertStatus(200);
        $response->assertSee($especie->genero);
    }

    #[Test] //Para comprobar que un admin puede crear una especie
    public function test_admin_crear_especie()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/especies', [
            'genero' => 'Boletus',
            'especie' => 'B. edulis',
            'nombre_comun' => 'Calabaza',
            'toxicidad' => 'no tóxica',
            'comestibilidad' => 'excelente comestible'
        ]);

        $response->assertRedirect(route('especies.index'));
        $this->assertDatabaseHas('especies', [
            'genero' => 'Boletus',
            'especie' => 'B. edulis',
        ]);
    }

    #[Test] //Para comprobar que un usuario estándar no puede acceder a la creación de especies
    public function test_estandar_no_crear_especie()
    {
        $user = User::factory()->create(['role' => 'standard']);

        $response = $this->actingAs($user)->get('/especies/create');

        $response->assertRedirect(route('especies.index'));
        $response->assertSessionHas('fail');
    }

    #[Test] //Para comprobar que un admin puede eliminar una especie
    public function test_admin_eliminar_especie()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $especie = Especie::factory()->create();

        $response = $this->actingAs($admin)->delete("/especies/{$especie->id}");

        $response->assertRedirect(route('especies.index'));
        $this->assertDatabaseMissing('especies', ['id' => $especie->id]);
    }

    #[Test] //Para comprobar que un usuario estándar no puede eliminar una especie
    public function test_estandar_no_eliminar_especie()
    {
        $user = User::factory()->create(['role' => 'standard']);
        $especie = Especie::factory()->create();

        $response = $this->actingAs($user)->delete("/especies/{$especie->id}");

        $response->assertRedirect(route('especies.index'));
        $response->assertSessionHas('fail');
        $this->assertDatabaseHas('especies', ['id' => $especie->id]);
    }

    #[Test] //Para comprobar que un usuario puede enviar una propuesta
    public function test_enviar_propuesta()
    {
        Mail::fake();
        $user = User::factory()->create(['role' => 'standard']);
        $admin = User::factory()->create(['role' => 'admin']); //Para que haya un usuario admin al que enviar el email

        $this->actingAs($user)->post(route('especies.sendsuggestion'), [
            'genero' => 'Amanita',
            'especie' => 'A. muscaria',
        ]);

        Mail::assertSent(SuggestionMail::class);
    }

}
