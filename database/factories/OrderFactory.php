<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_harga' => fake()->randomFloat(2, 0, 9999999999999999.99),
            'status' => fake()->randomElement(["pending","proses","dikirim","komplain","selesai"]),
            'status_pembayaran' => fake()->randomElement(["pending","dibayar","gagalselesai"]),
        ];
    }
}
