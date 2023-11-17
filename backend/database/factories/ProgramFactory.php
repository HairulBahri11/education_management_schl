<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_program' => $this->faker->name(),
            'kategori_program' => $this->faker->randomElement(['Trial', 'Premium']),
            'deskripsi' => $this->faker->text(),
            'gambar' => $this->faker->imageUrl(),
            'harga' => $this->faker->randomDigit(),
            'active' => $this->faker->randomElement([true, false]),
            'jeniskelas_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
