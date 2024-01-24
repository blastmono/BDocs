<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SuperAdminSeeder::class,
            OrganizacionSeeder::class,
            MateriaSeeder::class,
            InstitucionSeeder::class,
            EstadosSeeder::class,
            PrefijoSeeder::class,
            TipoDocSeeder::class,
        ]);
    }
}
