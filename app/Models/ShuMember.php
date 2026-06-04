<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShuMember extends Model
{
    protected $fillable = [
        'shu_id',
        'user_id',
        'amount',
        'status',
        'distributed_at',
        'distribution_method',
        'taken_at',
    ];

    protected function casts(): array
    {
        return [
            'distributed_at' => 'datetime',
            'taken_at' => 'datetime',
        ];
    }

    public function shu(): BelongsTo
    {
        return $this->belongsTo(Shu::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
