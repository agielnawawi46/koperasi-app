<?php

namespace Database\Factories;

use App\Models\Installment;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstallmentFactory extends Factory
{
    protected $model = Installment::class;

    public function definition(): array
    {
        return [
            'loan_id' => Loan::factory(),
            'installment_number' => 1,
            'amount' => fake()->randomFloat(2, 100000, 1000000),
            'principal' => fake()->randomFloat(2, 80000, 800000),
            'interest' => fake()->randomFloat(2, 20000, 200000),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'status' => 'pending',
            'fine_amount' => 0,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
            'paid_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    public function late(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'late',
            'due_date' => fake()->dateTimeBetween('-3 months', '-1 month'),
            'fine_amount' => fake()->randomFloat(2, 5000, 50000),
        ]);
    }
}
