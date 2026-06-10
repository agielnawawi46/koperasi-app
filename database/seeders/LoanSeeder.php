<?php

namespace Database\Seeders;

use App\Models\Installment;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('anggota')->get();
        $pengurus = User::role('pengurus')->first();

        foreach ($users as $index => $user) {
            if ($index >= 10) {
                break;
            }

            $amount = fake()->randomElement([1000000, 2000000, 3000000, 5000000, 10000000]);
            $tenure = fake()->randomElement([6, 12, 24]);
            $interestRate = 10;
            $totalInterest = $amount * $interestRate / 100;
            $totalPayment = $amount + $totalInterest;
            $monthlyPayment = $totalPayment / $tenure;

            $statuses = ['active', 'active', 'active', 'paid', 'paid', 'pending', 'approved', 'ready_for_disbursement'];
            $status = $statuses[$index % count($statuses)];

            $loan = Loan::create([
                'loan_number' => 'LN-'.str_pad((string) ($index + 1), 5, '0', STR_PAD_LEFT),
                'user_id' => $user->id,
                'amount' => $amount,
                'interest_rate' => $interestRate,
                'tenure_months' => $tenure,
                'monthly_payment' => round($monthlyPayment, 2),
                'total_interest' => $totalInterest,
                'total_payment' => $totalPayment,
                'status' => $status,
                'purpose' => fake()->randomElement([
                    'Biaya pendidikan anak',
                    'Renovasi rumah',
                    'Pembelian kendaraan',
                    'Modal usaha',
                    'Biaya kesehatan',
                    'Pembelian elektronik',
                ]),
                'approved_by' => in_array($status, ['active', 'paid', 'approved']) ? $pengurus->id : null,
                'approved_at' => in_array($status, ['active', 'paid', 'approved']) ? now()->subMonths(fake()->numberBetween(1, 6)) : null,
            ]);

            if (in_array($status, ['active', 'paid'])) {
                $paidInstallments = $status === 'paid' ? $tenure : fake()->numberBetween(1, max(1, $tenure - 2));
                for ($i = 1; $i <= $tenure; $i++) {
                    $dueDate = $loan->approved_at->copy()->addMonths($i - 1);
                    $isPaid = $i <= $paidInstallments;

                    Installment::create([
                        'loan_id' => $loan->id,
                        'installment_number' => $i,
                        'amount' => round($monthlyPayment, 2),
                        'principal' => round($amount / $tenure, 2),
                        'interest' => round($totalInterest / $tenure, 2),
                        'due_date' => $dueDate,
                        'paid_date' => $isPaid ? $dueDate->copy()->addDays(fake()->numberBetween(0, 5)) : null,
                        'status' => $isPaid ? 'paid' : 'pending',
                        'fine_amount' => 0,
                        'payment_reference' => $isPaid ? 'PAY-'.$loan->loan_number.'-'.str_pad((string) $i, 3, '0', STR_PAD_LEFT) : null,
                    ]);
                }
            }
        }
    }
}
