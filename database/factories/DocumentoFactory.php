<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documento>
 */
class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ejemplares' => $this->faker->randomDigitNot(0),
            'hojas'=> $this->faker->randomDigit(),
            'materia_id' => $this->faker->numberBetween($min=1,$max=3),
            'num_doc'=>$this->faker->randomDigitNot(0),
            'clasificacion'=>$this->faker->randomElement(['PUBLICO','RESERVADO','SECRETO']),
            'fecha_doc'=>$this->faker->date($format= 'Y-m-d', $max='now'),
            'objeto'=>$this->faker->realText($maxNbChars=140, $indexSize =2),
            'organizacion_id' => 1,//$this->faker->numberBetween($min=1,$max=12),
            'tipo_documento_id' => $this->faker->numberBetween($min=1,$max=3),
            'tipo_tramite_id' => $this->faker->numberBetween($min=1,$max=3),
            'user_id'=> $this->faker->numberBetween($min=1,$max=3),
            'rutaArchivo'=>'uploads/kardex/1705679244.pdf',

        ];
    }
}
