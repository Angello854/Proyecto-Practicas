<?php

namespace App\Providers;

use App\Models\Asignatura;
use App\Models\Empresa;
use App\Models\Tarea;
use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\AsignaturaPolicy;
use App\Policies\EmpresaPolicy;
use App\Policies\TareaPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Activitylog\Models\Activity;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        User::class => UserPolicy::class,
        Empresa::class => EmpresaPolicy::class,
        Asignatura::class => AsignaturaPolicy::class,
        Tarea::class => TareaPolicy::class,
        Activity::class => ActivityPolicy::class
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::policy(User::class, UserPolicy::class);
    }
}
