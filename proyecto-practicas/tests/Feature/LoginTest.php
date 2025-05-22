<?php

namespace Tests\Feature;

use App\Enums\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testSeeLogin(): void
    {
        //Nos aseguramos de ver el login
        $this->get('http://proyecto-practicas.test/dashboard/login')
            ->assertStatus(200)
            ->assertSee('Entre a su cuenta');
    }

    public function testLogin(): void
    {
        //Creamos el usuario
        $user = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuariologin@gmail.com',
            'rol' => Rol::Alumno,
            'password' => bcrypt('usuario'),
        ]);

        //Nos aseguramos de ver el login
        $this->get('http://proyecto-practicas.test/dashboard/login')
            ->assertSee('Entre a su cuenta');

        //Iniciamos sesión con el usuario y nos aseguramos de que vaya bien
        $this->actingAs($user)
            ->get('http://proyecto-practicas.test/dashboard')
            ->assertStatus(200);

        $this->assertAuthenticatedAs($user);

        //Borramos el usuario
        $user->delete();
    }

    public function testInvalidLogin(): void
    {
        // Aseguramos que no hay ningún usuario autenticado
        $this->assertGuest();

        // Intentamos acceder a una ruta protegida
        $response = $this->get('http://proyecto-practicas.test/dashboard');

        // Verificamos que redirige al login
        $response->assertRedirect('http://proyecto-practicas.test/dashboard/login');

        // Aseguramos de nuevo que no hay sesión iniciada
        $this->assertGuest();
    }

}
