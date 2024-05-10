<?php

namespace Database\Factories;

use App\Models\Empleados;
use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Empleados::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Obtener todos los IDs de proyectos existentes
        $proyectosIds = Proyecto::pluck('id');

        return [
            'nombre' => $this->faker->firstName,
            'apellidoP' => $this->faker->lastName,
            'apellidoM' => $this->faker->lastName,
            'puesto' => $this->faker->jobTitle,
            'departamento' => $this->faker->word,
            'fecha_nacimiento' => $this->faker->date(),
            'proyecto_id' => $this->faker->randomElement($proyectosIds), // Seleccionar aleatoriamente un ID de proyecto existente
        ];
    }
}
