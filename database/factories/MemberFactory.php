<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama'          => fake()->name(),
            'nim'           => '2310' . fake()->unique()->numerify('######'),
            'email'         => fake()->unique()->safeEmail(),
            'nomor_telepon' => fake()->phoneNumber(),
            'alamat'        => fake()->address(),
            'status'        => fake()->randomElement(['aktif', 'aktif', 'aktif', 'nonaktif']),
        ];
    }
}
