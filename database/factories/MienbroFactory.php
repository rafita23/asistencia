<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mienbro>
 */
class MienbroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_completo' => $this->faker->name, // Genera un nombre realista
            'direccion' => $this->faker->address, // Genera una dirección realista
            'telefono' => $this->faker->numberBetween(70000000, 79999999), // Genera un número de teléfono boliviano
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'), // Fecha entre hace 30 y 18 años
            'genero' => $this->faker->randomElement(['M', 'F']), // Aleatoriamente 'M' o 'F'
            'email' => $this->faker->unique()->safeEmail, // Genera un correo electrónico único
            'grado' => $this->faker->randomElement(['Primero A', 'Segundo B', 'Tercero A', 'Tercero B']), // Grados aleatorios
            'fotografia' => $this->faker->imageUrl(640, 480, 'people', true, 'Faker'),
        ];
    }
}
