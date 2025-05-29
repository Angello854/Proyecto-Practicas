<?php

namespace Tests\Feature;

use App\Enums\Rol;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Tarea;
use App\Models\Titulacion;
use App\Models\User;
use Tests\TestCase;

class CRUDTest extends TestCase
{

    public function testTarea(): void
    {
        $admin = User::factory()->create([
            "rol" => Rol::Admin,
        ]);


        $tarea = Tarea::create([
            'descripcion' => 'Tarea admin',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $admin->id,
        ]);

        $tarea2 = Tarea::create([
            'descripcion' => '1234dsasfewet134341324rasdsdqwe2421wdsaw4hkob092378',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $admin->id,
        ]);

        $this->actingAs($admin);
        //Ver
        $this->get('/dashboard/tareas')
            ->assertStatus(200)
            ->assertSee('Tarea admin')
            ->assertSee('1234dsasfewet134341324rasdsdqwe2421wdsaw4hkob092378');

        //Crear
        $this->assertDatabaseHas('tareas', ['descripcion' => 'Tarea admin']);
        $this->assertDatabaseHas('tareas', ['descripcion' => '1234dsasfewet134341324rasdsdqwe2421wdsaw4hkob092378']);
        //Editar
        $tarea->update(['descripcion' => 'Tarea editada']);
        $tarea2->update(['descripcion' => 'dghjwkpkdjfhfei298172346fyue8109387ft']);
        $this->assertEquals('Tarea editada', $tarea->fresh()->descripcion);
        $this->assertEquals('dghjwkpkdjfhfei298172346fyue8109387ft', $tarea2->fresh()->descripcion);
        $this->assertDatabaseHas('tareas', ['descripcion' => 'Tarea editada']);
        $this->assertDatabaseHas('tareas', ['descripcion' => 'dghjwkpkdjfhfei298172346fyue8109387ft']);
        //Borrar
        $admin->delete();
        $tarea->delete();
        $tarea2->delete();
        $this->assertDatabaseMissing('tareas', ['descripcion' => 'Tarea editada']);
        $this->assertDatabaseMissing('tareas', ['descripcion' => 'dghjwkpkdjfhfei298172346fyue8109387ft']);


    }

    public function testUser(): void
    {
        $admin = User::factory()->create([
            "rol" => Rol::Admin,
        ]);

        $user = User::create([
            'name' => 'Kiko',
            'email' => 'kiko@gmail.com',
            'password' => bcrypt('kiko'),
            'rol' => Rol::Alumno,
        ]);

        $user2 = User::create([
            'name' => 'asdkiwoqiwhr9310239847hfsjkalpslfjbvduv8w931',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'rol' => Rol::Alumno,
        ]);

        $this->actingAs($admin);
        //Ver
        $this->get('/dashboard/users')
            ->assertStatus(200)
            ->assertSee('Kiko')
            ->assertSee('asdkiwoqiwhr9310239847hfsjkalpslfjbvduv8w931');

        //Crear
        $this->assertDatabaseHas('users', ['name' => 'Kiko']);
        $this->assertDatabaseHas('users', ['name' => 'asdkiwoqiwhr9310239847hfsjkalpslfjbvduv8w931']);
        //Editar
        $user->update(['name' => 'Enrique']);
        $user2->update(['name' => '386139065gdsidfeygryudsidyf35813945']);
        $this->assertEquals('Enrique', $user->fresh()->name);
        $this->assertEquals('386139065gdsidfeygryudsidyf35813945', $user2->fresh()->name);
        $this->assertDatabaseHas('users', ['name' => 'Enrique']);
        $this->assertDatabaseHas('users', ['name' => '386139065gdsidfeygryudsidyf35813945']);
        //Borrar
        $admin->delete();
        $user->delete();
        $user2->delete();
        $this->assertDatabaseMissing('users', ['name' => 'Enrique']);
        $this->assertDatabaseMissing('users', ['name' => '386139065gdsidfeygryudsidyf35813945']);
    }

    public function testAsignatura(): void
    {
        $admin = User::factory()->create([
            "rol" => Rol::Admin,
        ]);

        $asignatura = Asignatura::create([
            'nombre' => 'Lengua',
        ]);

        $asignatura2 = Asignatura::create([
            'nombre' => 'asduisq9348718395098fdhjsaekf916',
        ]);

        $this->actingAs($admin);
        //Ver
        $this->get('/dashboard/asignaturas')
            ->assertStatus(200)
            ->assertSee('Lengua')
            ->assertSee('asduisq9348718395098fdhjsaekf916');

        //Crear
        $this->assertDatabaseHas('asignaturas', ['nombre' => 'Lengua']);
        $this->assertDatabaseHas('asignaturas', ['nombre' => 'asduisq9348718395098fdhjsaekf916']);

        //Editar
        $asignatura->update(['nombre' => 'Mates']);
        $asignatura2->update(['nombre' => 'dgfhgcvjckelkutrvbdioeifgfbvsio']);
        $this->assertEquals('Mates', $asignatura->fresh()->nombre);
        $this->assertEquals('dgfhgcvjckelkutrvbdioeifgfbvsio', $asignatura2->fresh()->nombre);
        $this->assertDatabaseHas('asignaturas', ['nombre' => 'Mates']);
        $this->assertDatabaseHas('asignaturas', ['nombre' => 'dgfhgcvjckelkutrvbdioeifgfbvsio']);

        //Borrar
        $admin->delete();
        $asignatura->delete();
        $asignatura2->delete();
        $this->assertDatabaseMissing('asignaturas', ['nombre' => 'Mates']);
        $this->assertDatabaseMissing('asignaturas', ['nombre' => 'dgfhgcvjckelkutrvbdioeifgfbvsio']);
    }

    public function testCurso(): void
    {
        $admin = User::factory()->create([
            "rol" => Rol::Admin,
        ]);

        $curso = Curso::create([
            'nombre' => 'Lengua',
        ]);

        $curso2 = Curso::create([
            'nombre' => '27489120fgdikfhdghxcd6731f',
        ]);

        $this->actingAs($admin);
        //Ver
        $this->get('/dashboard/cursos')
        ->assertStatus(200)
            ->assertSee('Lengua')
            ->assertSee('27489120fgdikfhdghxcd6731f');

        //Crear
        $this->assertDatabaseHas('cursos', ['nombre' => 'Lengua']);
        $this->assertDatabaseHas('cursos', ['nombre' => '27489120fgdikfhdghxcd6731f']);

        //Editar
        $curso->update(['nombre' => 'Mates']);
        $curso2->update(['nombre' => 'safnjlkwo347819380fgxisaoef391']);
        $this->assertEquals('Mates', $curso->fresh()->nombre);
        $this->assertEquals('safnjlkwo347819380fgxisaoef391', $curso2->fresh()->nombre);
        $this->assertDatabaseHas('cursos', ['nombre' => 'Mates']);
        $this->assertDatabaseHas('cursos', ['nombre' => 'safnjlkwo347819380fgxisaoef391']);

        //Borrar
        $admin->delete();
        $curso->delete();
        $curso2->delete();
        $this->assertDatabaseMissing('cursos', ['nombre' => 'Mates']);
        $this->assertDatabaseMissing('cursos', ['nombre' => 'safnjlkwo347819380fgxisaoef391']);
    }





    public function testTitulacion(): void
    {
        $admin = User::factory()->create([
            "rol" => Rol::Admin,
        ]);

        $titulacion = Titulacion::create([
            'nombre' => 'Lengua',
        ]);

        $titulacion2 = Titulacion::create([
            'nombre' => 'dsdljhqporu12890axbchjaoeiyf17398',
        ]);

        $this->actingAs($admin);
        //Ver
        $this->get('/dashboard/titulacions')
    ->assertStatus(200)
            ->assertSee('Lengua')
            ->assertSee('dsdljhqporu12890axbchjaoeiyf17398');

        //Crear
        $this->assertDatabaseHas('titulacion', ['nombre' => 'Lengua']);
        $this->assertDatabaseHas('titulacion', ['nombre' => 'dsdljhqporu12890axbchjaoeiyf17398']);

    //Editar
        $titulacion->update(['nombre' => 'Mates']);
        $titulacion2->update(['nombre' => 's019476hjkdoi7g6523bhcji3']);
        $this->assertEquals('Mates', $titulacion->fresh()->nombre);
        $this->assertEquals('s019476hjkdoi7g6523bhcji3', $titulacion2->fresh()->nombre);
        $this->assertDatabaseHas('titulacion', ['nombre' => 'Mates']);
        $this->assertDatabaseHas('titulacion', ['nombre' => 's019476hjkdoi7g6523bhcji3']);

        //Borrar
        $admin->delete();
        $titulacion->delete();
        $titulacion2->delete();
        $this->assertDatabaseMissing('titulacion', ['nombre' => 'Mates']);
        $this->assertDatabaseMissing('titulacion', ['nombre' => 's019476hjkdoi7g6523bhcji3']);
    }



    public function testEmpresa(): void
    {
        $admin = User::factory()->create([
            "rol" => Rol::Admin,
        ]);

        $empresa = Empresa::create([
            'nombre' => 'Hola',
        ]);

        $empresa2 = Empresa::create([
            'nombre' => 'poisydq793805ghxsoei7r6510',
        ]);

        $this->actingAs($admin);
        //Ver
        $this->get('/dashboard/empresas')
            ->assertStatus(200)
            ->assertSee('Hola')
            ->assertSee('poisydq793805ghxsoei7r6510');

        //Crear
        $this->assertDatabaseHas('empresas', ['nombre' => 'Hola']);
        $this->assertdatabaseHas('empresas', ['nombre' => 'poisydq793805ghxsoei7r6510']);
        //Editar
        $empresa->update(['nombre' => 'Adiós']);
        $empresa2->update(['nombre' => 'poi1u6470wvfgsu9q73265']);
        $this->assertEquals('Adiós', $empresa->fresh()->nombre);
        $this->assertEquals('poi1u6470wvfgsu9q73265', $empresa2->fresh()->nombre);
        $this->assertDatabaseHas('empresas', ['nombre' => 'Adiós']);
        $this->assertDatabaseHas('empresas', ['nombre' => 'poi1u6470wvfgsu9q73265']);
        //Borrar
        $admin->delete();
        $empresa->delete();
        $empresa2->delete();
        $this->assertDatabaseMissing('empresas', ['nombre' => 'Adiós']);
        $this->assertDatabaseMissing('empresas', ['nombre' => 'poi1u6470wvfgsu9q73265']);
    }
}
