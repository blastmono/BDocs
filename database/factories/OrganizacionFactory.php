<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizacion>
 */
class OrganizacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sigla'=>'DIPRO',
            'nombre'=>'Direccion de Proyectos y Tecnologias Estrategicas'
        ];
    }
}