<?php

namespace App\Providers;

use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Profesor;
use App\Models\User;
use App\Policies\AlumnoPolicy;
use App\Policies\CursoPolicy;
use App\Policies\ProfesorPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Alumno::class => AlumnoPolicy::class,
        Curso::class => CursoPolicy::class,
        Profesor::class => ProfesorPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
