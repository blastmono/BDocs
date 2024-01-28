<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //Roles
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            //Usuarios
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            //Documentos
            'view-document',
            'create-document',
            'edit-document',
            'delete-document',
            //Registrador
            'view-organizacion',
            'create-organizacion',
            'edit-organizacion',
            'delete-organizacion',
            //Auditoria
            'view-auditoria',
            //distribucion
            'view-distribucion',
            'create-distribucion',
            'edit-distribucion',
            'delete-distribucion',
            //Kardex
            'view-kardex',
            'create-kardex',
            'edit-kardex',
            'delete-kardex',
            //Configuracion
            'view-config',
            //Estado
            'view-estado',
            'create-estado',
            'edit-estado',
            'delete-estado',
            //bandeja
            'view-bandeja',
            //tareas
            'view-tareas',
            'create-tareas',
            'edit-tareas',
            'delete-tareas',
            'cumple-tareas',
            //

        ];

        foreach($permissions as $permission)
        {
            Permission::create(['name'=>$permission]);
        }
    }
}
