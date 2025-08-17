<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create([
            'nombre' => 'admin',
            'descripcion' => 'Administrador con permisos completos',
            'permisos' => [
                'alumnos.create',
                'alumnos.read',
                'alumnos.update',
                'alumnos.delete',
                'cursos.create',
                'cursos.read',
                'cursos.update',
                'cursos.delete',
                'profesores.create',
                'profesores.read',
                'profesores.update',
                'profesores.delete',
            ]
        ]);

        $gestorRole = Role::create([
            'nombre' => 'gestor',
            'descripcion' => 'Gestor con permisos limitados',
            'permisos' => [
                'alumnos.create',
                'alumnos.read',
                'alumnos.update',
                'alumnos.delete',
                'cursos.create',
                'cursos.read',
                'cursos.update',
                'cursos.delete',
                'profesores.read', // Solo consulta para profesores
            ]
        ]);

        // Crear usuario admin si no existe
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]);
        }

        // Crear usuario gestor para pruebas
        if (!User::where('email', 'gestor@gestor.com')->exists()) {
            User::create([
                'name' => 'Gestor de Prueba',
                'email' => 'gestor@gestor.com',
                'password' => Hash::make('password'),
                'role_id' => $gestorRole->id,
            ]);
        }
    }
}
