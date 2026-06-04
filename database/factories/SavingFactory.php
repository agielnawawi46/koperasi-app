<?php

namespace Database\Factories;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavingFactory extends Factory
{
    protected $model = Saving::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['pokok', 'wajib', 'sukarela']),
            'balance' => fake()->randomFloat(2, 100000, 5000000),
        ];
    }

    public function pokok(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'pokok',
            'balance' => 500000,
        ]);
    }

    public function wajib(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'wajib',
            'balance' => fake()->randomFloat(2, 100000, 5000000),
        ]);
    }

    public function sukarela(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'sukarela',
            'balance' => fake()->randomFloat(2, 100000, 2000000),
        ]);
    }
}
