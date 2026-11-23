<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isbn'         => fake()->unique()->numerify('978##########'),
            'judul'        => fake()->sentence(fake()->numberBetween(2, 5)),
            'penulis'      => fake()->name(),
            'penerbit'     => fake()->company(),
            'tahun_terbit' => fake()->numberBetween(2000, 2024),
            'stok'         => fake()->numberBetween(1, 15),
            'category_id'  => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        ];
    }
}
