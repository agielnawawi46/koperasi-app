<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        $amount = fake()->randomElement([1000000, 2000000, 3000000, 5000000, 10000000]);
        $tenure = fake()->randomElement([6, 12, 24]);
        $interestRate = 10;
        $totalInterest = $amount * $interestRate / 100;
        $totalPayment = $amount + $totalInterest;
        $monthlyPayment = $totalPayment / $tenure;

        return [
            'loan_number' => 'LN-'.fake()->unique()->numerify('#####'),
            'user_id' => User::factory(),
            'amount' => $amount,
            'interest_rate' => $interestRate,
            'tenure_months' => $tenure,
            'monthly_payment' => round($monthlyPayment, 2),
            'total_interest' => $totalInterest,
            'total_payment' => $totalPayment,
            'status' => 'pending',
            'purpose' => fake()->randomElement([
                'Biaya pendidikan anak',
                'Renovasi rumah',
                'Pembelian kendaraan',
                'Modal usaha',
                'Biaya kesehatan',
            ]),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_by' => User::factory(),
            'approved_at' => now(),
        ]);
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'approved_by' => User::factory(),
            'approved_at' => now()->subMonths(fake()->numberBetween(1, 6)),
        ]);
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
            'approved_by' => User::factory(),
            'approved_at' => now()->subMonths(fake()->numberBetween(7, 12)),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'approved_by' => User::factory(),
            'approved_at' => now(),
        ]);
    }
}
