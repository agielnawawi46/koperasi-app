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
        'tgl_tagihan',
        'phone',
        'website',
        'logo',
    ];
}
