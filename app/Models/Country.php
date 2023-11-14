<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_code',
        'exchange_rate',
        'currency_code',
        'symbol',
        'status'
    ];
}
