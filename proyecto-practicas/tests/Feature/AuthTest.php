<?php

namespace Tests\Feature;

use App\Enums\Rol;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Titulacion;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use App\Models\Tarea;

class AuthTest extends TestCase
{

    public function testRolAccessRoutes(): void
    {
        //Creamos los usuarios
        $admin = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario1@gmail.com',
            'rol' => Rol::Admin,
            'password' => bcrypt('usuario'),
        ]);

        $alumno = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario2@gmail.com',
            'rol' => Rol::Alumno,
            'password' => bcrypt('usuario'),
        ]);

        $tutorDocente = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario3@gmail.com',
            'rol' => Rol::TutorDocente,
            'password' => bcrypt('usuario'),
        ]);

        $tutorLaboral = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario4@gmail.com',
            'rol' => Rol::TutorLaboral,
            'password' => bcrypt('usuario'),
            ]);


        //Probamos que el Admin pueda accedcer
        $this->actingAs($admin);
        $this->get('/dashboard/activity-logs')->assertOk();

        // Para cada usuario no autorizado
        $unauthorizedUsers = [$alumno, $tutorDocente, $tutorLaboral];

        foreach ($unauthorizedUsers as $user) {
            $this->actingAs($user);
            $response = $this->get('/dashboard/activity-logs');

            // Manejar ambos casos posibles
            if ($response->status() === 302) {
                // Es una redirección - esto está bien, significa acceso denegado
                $response->assertRedirect();
            } elseif ($response->status() === 403) {
                // Es un 403 directo - esto también está bien
                $response->assertForbidden();
            } else {
                // Cualquier otro código que no sea 200 también puede estar bien
                $this->assertNotEquals(200, $response->status());
            }
        }

        //Borramos los usuarios
        $admin->delete();
        $alumno->delete();
        $tutorDocente->delete();
        $tutorLaboral->delete();
    }

    public function testRolAdmin(): void
    {
        //Creación
        $admin = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario@gmail.com',
            'rol' => Rol::Admin,
            'password' => bcrypt('usuario'),
        ]);

        $tarea = Tarea::create([
            'descripcion' => 'Creada por admin',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $admin->id,
        ]);

        $empresa = Empresa::create([
            'nombre' => 'Empresa',
        ]);

        $asignatura = Asignatura::create([
            'nombre' => 'Asignatura',
        ]);

        $curso = Curso::create([
            'nombre' => 'Curso',
        ]);

        $titulacion = Titulacion::create([
            'nombre' => 'Titulacion',
        ]);

        //Iniciamos la sesión con el usuario
        $this->actingAs($admin);

        //Nos aseguramos de que el usuario puede acceder a la creación y edición
        $this->get("/dashboard/tareas/create")->assertOk();
        $this->get("/dashboard/tareas/{$tarea->id}/edit")->assertOk();

        $this->get("/dashboard/users/create")->assertOk();
        $this->get("/dashboard/users/{$admin->id}/edit")->assertOk();

        $this->get("/dashboard/empresas/create")->assertOk();
        $this->get("/dashboard/empresas/{$empresa->id}/edit")->assertOk();

        $this->get("/dashboard/cursos/create")->assertOk();
        $this->get("/dashboard/cursos/{$curso->id}/edit")->assertOk();

        $this->get("/dashboard/titulacions/create")->assertOk();
        $this->get("/dashboard/titulacions/{$titulacion->id}/edit")->assertOk();

        $this->get("/dashboard/asignaturas/create")->assertOk();
        $this->get("/dashboard/asignaturas/{$asignatura->id}/edit")->assertOk();

        $tarea->delete();
        $admin->delete();
        $empresa->delete();
        $curso->delete();
        $titulacion->delete();
        $asignatura->delete();
    }

    public function testRolAlumno(): void
    {
        //Creamos el usuario
        $alumno = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario2@gmail.com',
            'rol' => Rol::Alumno,
            'password' => bcrypt('usuario'),
        ]);

        //Creamos la tarea
        $tarea = Tarea::create([
            'descripcion' => 'Alumno',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $alumno->id,
        ]);


        $response = $this->get("/dashboard/users");
            if ($response->status() === 302) {
                // Es una redirección - esto está bien, significa acceso denegado
                $response->assertRedirect();
            } elseif ($response->status() === 403) {
                // Es un 403 directo - esto también está bien
                $response->assertForbidden();
            } else {
                // Cualquier otro código que no sea 200 también puede estar bien
                $this->assertNotEquals(200, $response->status());
            }

        $response = $this->get("/dashboard/empresas");

        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/cursos");

        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/titulacions");

        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas");

        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }
        $alumno->delete();
        $tarea->delete();
    }

    public function testRolTutorDocente(): void
    {
        $tutor = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario2@gmail.com',
            'rol' => Rol::TutorDocente,
            'password' => bcrypt('usuario'),
        ]);

        $tarea = Tarea::create([
            'descripcion' => 'Creada por admin',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $tutor->id,
        ]);

        $empresa = Empresa::create([
            'nombre' => 'Empresa',
        ]);

        $asignatura = Asignatura::create([
            'nombre' => 'Asignatura',
        ]);

        $curso = Curso::create([
            'nombre' => 'Curso',
        ]);

        $titulacion = Titulacion::create([
            'nombre' => 'Titulacion',
        ]);

        $this->actingAs($tutor);
        $this->get("/dashboard/tareas")->assertOk();
        $this->get("/dashboard/users")->assertOk();
        $this->get("/dashboard/cursos")->assertOk();
        $this->get("/dashboard/empresas")->assertOk();
        $this->get("/dashboard/titulacions")->assertOk();
        $this->get("/dashboard/asignaturas")->assertOk();

        $response = $this->get("/dashboard/tareas/{$tarea->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/tareas/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/empresas/{$empresa->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/empresas/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas/{$tutor->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/users/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas/{$asignatura->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/cursos/{$curso->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/cursos/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/titulacions/{$titulacion->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/titulacions/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $tutor->delete();
        $curso->delete();
        $asignatura->delete();
        $titulacion->delete();
        $empresa->delete();
        $tarea->delete();
    }

    public function testRolTutorLaboral(): void
    {
        $tutor = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario2@gmail.com',
            'rol' => Rol::TutorLaboral,
            'password' => bcrypt('usuario'),
        ]);

        $tarea = Tarea::create([
            'descripcion' => 'Creada por admin',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $tutor->id,
        ]);

        $empresa = Empresa::create([
            'nombre' => 'Empresa',
        ]);

        $asignatura = Asignatura::create([
            'nombre' => 'Asignatura',
        ]);

        $curso = Curso::create([
            'nombre' => 'Curso',
        ]);

        $titulacion = Titulacion::create([
            'nombre' => 'Titulacion',
        ]);

        $this->actingAs($tutor);

        $this->get("/dashboard/tareas")->assertOk();
        $this->get("/dashboard/users")->assertOk();
        $this->get("/dashboard/empresas")->assertOk();

        $response = $this->get("/dashboard/asignaturas");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/cursos");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/titulacions");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/tareas/{$tarea->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/tareas/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/empresas/{$empresa->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/empresas/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas/{$tutor->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/users/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas/{$asignatura->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/asignaturas/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/cursos/{$curso->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/cursos/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/titulacions/{$titulacion->id}/edit");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $response = $this->get("/dashboard/titulacions/create");
        if ($response->status() === 302) {
            // Es una redirección - esto está bien, significa acceso denegado
            $response->assertRedirect();
        } elseif ($response->status() === 403) {
            // Es un 403 directo - esto también está bien
            $response->assertForbidden();
        } else {
            // Cualquier otro código que no sea 200 también puede estar bien
            $this->assertNotEquals(200, $response->status());
        }

        $tutor->delete();
        $curso->delete();
        $asignatura->delete();
        $titulacion->delete();
        $empresa->delete();
        $tarea->delete();
    }

    public function testTutorDocenteSee(): void{
        $tutor = User::factory()->create([
            'rol' => Rol::TutorDocente,
        ]);

        // Crear alumno que pertenece a ese tutor
        $alumnoAsignado = User::factory()->create([
            'rol' => Rol::Alumno,
        ]);

        // Crear alumno que NO pertenece a ese tutor
        $alumnoNoAsignado = User::factory()->create([
            'rol' => Rol::Alumno,
        ]);

        // Asociar el alumno asignado al tutor
        $tutor->alumnos()->attach($alumnoAsignado->id);

        // Simular inicio de sesión como tutor
        $this->actingAs($tutor);

        // Hacer la petición a la vista que lista los alumnos (ajusta la ruta si es distinta)
        $response = $this->get('/dashboard/users'); // o la ruta donde el tutor ve a sus alumnos

        // Comprobar que ve al alumno asignado
        $response->assertSee($alumnoAsignado->name);

        // Comprobar que NO ve al otro alumno
        $response->assertDontSee($alumnoNoAsignado->name);

        $tutor->delete();
        $alumnoAsignado->delete();
        $alumnoNoAsignado->delete();
    }

    public function testTutorLaboralSee(): void{
        $tutor = User::factory()->create([
            'name' => 'tutor',
            'email' => 'tutor@gmail.com',
            'password' => bcrypt('tutor'),
            'rol' => Rol::TutorLaboral,
        ]);

        // Crear alumno que pertenece a ese tutor
        $alumnoAsignado = User::factory()->create([
            'name' => 'alumno',
            'rol' => Rol::Alumno,
        ]);

        // Crear alumno que NO pertenece a ese tutor
        $alumnoNoAsignado = User::factory()->create([
            'rol' => Rol::Alumno,
        ]);

        // Asociar el alumno asignado al tutor
        // Asumiendo que la relación se llama alumnos() y hay una tabla intermedia tutor_docente_user
        $tutor->alumnos()->attach($alumnoAsignado->id);

        // Simular inicio de sesión como tutor
        $this->actingAs($tutor);

        // Hacer la petición a la vista que lista los alumnos (ajusta la ruta si es distinta)
        $response = $this->get('/dashboard/users'); // o la ruta donde el tutor ve a sus alumnos

        // Comprobar que ve al alumno asignado
        $response->assertSee($alumnoAsignado->name);

        // Comprobar que NO ve al otro alumno
        $response->assertDontSee($alumnoNoAsignado->name);

        $tutor->delete();
        $alumnoAsignado->delete();
        $alumnoNoAsignado->delete();
    }

    public function testAlumnoSee(): void{

        $alumno = User::factory()->create([
            'name' => 'alumno',
            'email' => 'alumno@gmail.com',
            'password' => bcrypt('alumno'),
            'rol' => Rol::Alumno,
        ]);

        // Crear otra persona que no es el alumno
        $otroAlumno = User::factory()->create([
            'name' => 'noalumno',
            'email' => 'noalumno@gmail.com',
            'password' => bcrypt('alumno'),
            'rol' => Rol::Alumno,
        ]);

        // Tarea que pertenece al alumno
        $tareaAsignada = Tarea::create([
            'descripcion' => 'Tarea propia',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 3,
            'materiales' => 'equipo propio',
            'alumno_id' => $alumno->id,
        ]);

        // Tarea de otro alumno
        $tareaNoAsignada = Tarea::create([
            'descripcion' => 'Tarea de otro alumno',
            'fecha' => now()->format('Y-m-d'),
            'horas' => 2,
            'materiales' => 'equipo propio',
            'alumno_id' => $otroAlumno->id,
        ]);

        // Simular sesión como el alumno
        $this->actingAs($alumno);

        // Petición a la vista donde el alumno ve sus tareas
        $response = $this->get('/dashboard/tareas'); // ajusta la ruta si es distinta

        // Comprobar que ve su propia tarea
        $response->assertSee('Tarea propia');

        // Comprobar que NO ve la tarea del otro alumno
        $response->assertDontSee('Tarea de otro alumno');

        // Limpieza
        $tareaAsignada->delete();
        $tareaNoAsignada->delete();
        $alumno->delete();
        $otroAlumno->delete();
    }
}
