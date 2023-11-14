<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
        'image',
        'quantity',
        'quantity_alert',
        'status',
    ];

    public function getPrice() {
        if (auth()->check()) {
            $user_currency = auth()->user()->country;
        } else {
            // If user is not authenticated, set default currency for Nigeria
            $user_currency = Country::find(1);
        }

        $price = $this->price * ($user_currency?->exchange_rate);
        $symbol = $user_currency?->symbol;
        return $symbol . ' ' . number_format($price, 2);
    }
}
