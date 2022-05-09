<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //0 -> TI, 1 -> CC
        return [
            "nombre"           => $this->faker->name,
            "email"           => $this->faker->unique()->email,
            "tipo_documento"   => rand(0,1),
            "numero_documento" => $this->faker->unique()->numberBetween(1111111111,9999999999),
            "ofertas_id"        => rand(1,5)
        ];
    }
}
