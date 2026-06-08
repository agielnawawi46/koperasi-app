<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    protected $fillable = [
        'loan_number',
        'user_id',
        'amount',
        'interest_rate',
        'tenure_months',
        'monthly_payment',
        'total_interest',
        'total_payment',
        'status',
        'purpose',
        'payment_method',
        'approved_by',
        'approved_at',
        'disbursed_by',
        'disbursed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'disbursed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function disbursedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disbursed_by');
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }
}
