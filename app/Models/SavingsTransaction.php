<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingsTransaction extends Model
{
    protected $fillable = [
        'saving_id',
        'user_id',
        'type',
        'amount',
        'description',
        'transaction_date',
        'reference',
        'status',
        'payment_method',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'transaction_date' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    public function savingAccount(): BelongsTo
    {
        return $this->belongsTo(Saving::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
