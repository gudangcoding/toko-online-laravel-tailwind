<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\User;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->word(),
            'konten' => fake()->text(),
            'gambar' => fake()->word(),
            'user_id' => User::factory(),
            'tanggal_publikasi' => fake()->dateTime(),
        ];
    }
}
