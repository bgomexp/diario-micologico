<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Entrada;
use App\Models\Especie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;

class EntradaTest extends TestCase
{
    use RefreshDatabase;

    #[Test] //Para comprobar si un usuario puede crear una entrada
    public function test_crear_entrada()
    {
        $user = User::factory()->create();
        $especie = Especie::factory()->create();

        $response = $this->actingAs($user)->post('/entradas', [
            'titulo' => 'Primera entrada',
            'fecha' => Carbon::now()->format('d-m-Y'),
            'lat' => 45.5,
            'lng' => -3.5,
            'comentarios' => 'Una excursión genial',
            'setas' => [
                ['especie' => $especie->id, 'cantidad' => 3],
            ],
        ]);

        $response->assertRedirect(route('entradas.index'));
        $this->assertDatabaseHas('entradas', [
            'titulo' => 'Primera entrada',
            'id_usuario' => $user->id,
        ]);

        $this->assertDatabaseHas('entrada_especie', [
            'cantidad' => 3,
            'especie_id' => $especie->id
        ]);
    }

    #[Test] //Para comprobar si un usuario puede ver sus entradas
    public function test_ver_entradas()
    {
        $user = User::factory()->create();
        $entrada = Entrada::factory()->create([
            'id_usuario' => $user->id,
        ]);

        $response = $this->actingAs($user)->get("/entradas/{$entrada->id}");

        $response->assertStatus(200);
        $response->assertSee($entrada->titulo);
    }

    #[Test] //Para comprobar que un usuario no puede ver las entradas de otro
    public function test_ver_solo_entradas_propias()
    {
        $user = User::factory()->create();
        $otro = User::factory()->create();

        $entrada = Entrada::factory()->create([
            'id_usuario' => $otro->id,
        ]);

        $response = $this->actingAs($user)->get("/entradas/{$entrada->id}");

        $response->assertRedirect(route('entradas.index'));
        $response->assertSessionHas('fail');
    }

    #[Test] //Para comprobar si un usuario puede actualizar sus entradas
    public function test_actualizar_entrada()
    {
        $user = User::factory()->create();
        $entrada = Entrada::factory()->create([
            'id_usuario' => $user->id,
        ]);

        $response = $this->actingAs($user)->put("/entradas/{$entrada->id}", [
            'titulo' => 'Entrada actualizada',
            'fecha' => Carbon::now()->format('d-m-Y'),
            'comentarios' => 'Comentario editado',
            'setas' => [],
        ]);

        $response->assertRedirect(route('entradas.index'));
        $this->assertDatabaseHas('entradas', [
            'id' => $entrada->id,
            'titulo' => 'Entrada actualizada',
        ]);
        $this->assertDatabaseMissing('entrada_especie', [
        'entrada_id' => $entrada->id,
        ]);
    }

    #[Test] //Para comprobar si un usuario puede eliminar una entrada
    public function test_eliminar_entrada()
    {
        $user = User::factory()->create();
        $entrada = Entrada::factory()->create([
            'id_usuario' => $user->id,
        ]);
        $especie = Especie::factory()->create();
        $entrada->especies()->attach($especie->id, ['cantidad' => 3]);

        $response = $this->actingAs($user)->delete("/entradas/{$entrada->id}");

        $response->assertRedirect(route('entradas.index'));
        $this->assertDatabaseMissing('entradas', [
            'id' => $entrada->id,
        ]);
        $this->assertDatabaseMissing('entrada_especie', [
        'entrada_id' => $entrada->id,
        ]);
    }

    #[Test] //Para comprobar que un usuario no puede eliminar las entradas de otro
    public function test_eliminar_solo_entradas_propias()
    {
        $user = User::factory()->create();
        $otro = User::factory()->create();
        $entrada = Entrada::factory()->create([
            'id_usuario' => $otro->id,
        ]);

        $response = $this->actingAs($user)->delete("/entradas/{$entrada->id}");

        $response->assertRedirect(route('entradas.index'));
        $response->assertSessionHas('fail');
        $this->assertDatabaseHas('entradas', [
            'id' => $entrada->id,
        ]);
    }
}
