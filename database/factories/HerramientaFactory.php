<?php

namespace Database\Factories;

use App\Models\Herramienta;
use Illuminate\Database\Eloquent\Factories\Factory;

class HerramientaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Herramienta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'cantidadDisponible' => $this->faker->numberBetween(0, 5),
            'descripcion' => $this->faker->sentence,
        ];
    }
}

