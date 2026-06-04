<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'name' => 'Koperasi '.fake()->company(),
            'company_name' => fake()->company(),
            'email' => fake()->companyEmail(),
            'address' => fake()->address(),
            'pokok_amount' => 500000,
            'wajib_amount' => 100000,
            'bunga_rate' => 10,
            'metode' => 'flat',
            'payment_method' => 'bulanan',
            'tgl_tagihan' => 5,
        ];
    }
}
