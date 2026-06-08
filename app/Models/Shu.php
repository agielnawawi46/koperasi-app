<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shu extends Model
{
    protected $table = 'shu';

    protected $fillable = [
        'year',
        'total_income',
        'total_expenses',
        'total_amount',
        'distributed_amount',
        'remaining_amount',
        'status',
        'notes',
        'calculated_at',
    ];

    protected function casts(): array
    {
        return [
            'calculated_at' => 'datetime',
        ];
    }

    public function members(): HasMany
    {
        return $this->hasMany(ShuMember::class);
    }
}
