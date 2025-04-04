<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Produk;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'produk_id' => Produk::factory(),
            'jumlah' => fake()->numberBetween(-10000, 10000),
            'harga' => fake()->randomFloat(2, 0, 9999999999999999.99),
            'subtotal' => fake()->randomFloat(2, 0, 9999999999999999.99),
        ];
    }
}
