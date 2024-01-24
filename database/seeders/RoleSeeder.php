<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'Super Admin']);
        $admin = Role::create(['name'=>'Admin']);
        $documentManager = Role::create(['name'=>'Document Manager']);
        $auditor = Role::create(['name'=>'Auditor']);
        
        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-document',
            'edit-document',
            'delete-document',
        ]);

        $documentManager->givePermissionTo([
            'view-document',
            'create-document',
            'edit-document',
            'delete-document',
            'view-bandeja',
            'view-kardex',
            'edit-kardex',
            'create-kardex'
        ]);

        $auditor->givePermissionTo([
            'view-auditoria',
        ]);
    }
}
