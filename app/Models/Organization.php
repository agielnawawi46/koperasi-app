<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'address',
        'pokok_amount',
        'wajib_amount',
        'bunga_rate',
        'metode',
        'payment_method',
        'payroll_enabled',
        'payroll_date',
        'max_salary_deduction',
        'max_tenor',
        'max_loan_percentage',
        'max_loan_amount',
        'minimum_cash_reserve',
        'require_active_member',
        'shu_savings_allocation',
        'shu_loan_allocation',
        'shu_reserve_allocation',
        'shu_social_allocation',
        'phone',
        'website',
        'logo',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
    ];

    protected function casts(): array
    {
        return [
            'payroll_enabled' => 'boolean',
            'require_active_member' => 'boolean',
        ];
    }
}
