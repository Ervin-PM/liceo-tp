<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $perms = [
            // Usuarios
            'users.view','users.create','users.update','users.delete','roles.manage',
            // Alumnos
            'alumnos.view','alumnos.create','alumnos.update','alumnos.delete',
            // Asistencia
            'asistencia.view','asistencia.take','asistencia.report',
            // Retiros diarios
            'retiros.view','retiros.create',
            // Suspensiones
            'suspensiones.view','suspensiones.create','suspensiones.update',
            // Retiros definitivos
            'retiros_def.view','retiros_def.create',
            // Convivencia
            'convivencia.view','convivencia.create','convivencia.update',
            // Reportes
            'reportes.generate',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $roles = [
            'Administrador' => $perms,
            'Director' => array_filter($perms, fn($p)=> str_contains($p,'reportes') || str_contains($p,'suspensiones') || str_contains($p,'alumnos') || str_contains($p,'asistencia')),
            'UTP' => array_filter($perms, fn($p)=> str_contains($p,'reportes') || str_contains($p,'suspensiones') || str_contains($p,'alumnos')),
            'Docente' => ['alumnos.view','asistencia.take','asistencia.view','asistencia.report'],
            'Inspector' => ['asistencia.view','asistencia.take','retiros.view','retiros.create'],
            'Convivencia' => ['convivencia.view','convivencia.create','convivencia.update','suspensiones.view','suspensiones.create'],
            'Administrativo' => ['alumnos.view','alumnos.create','alumnos.update'],
            'Alumno' => ['alumnos.view']
        ];

        foreach ($roles as $roleName => $rolePerms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePerms);
        }
    }
}
