<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\Produk;

class ProdukFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produk::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
            'deskripsi' => fake()->text(),
            'harga' => fake()->randomFloat(2, 0, 9999999999999999.99),
            'satuan' => fake()->word(),
            'ukuran' => fake()->word(),
            'stok' => fake()->numberBetween(-10000, 10000),
            'gambar' => fake()->word(),
            'kategori_id' => Kategori::factory(),
        ];
    }
}
