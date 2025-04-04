<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'user_id', 'payment_type', 'provider_payment_token', 'card_last_four', 'card_brand', 'expiry_month', 'expiry_year', 'billing_zip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_method_id', 'id');
    }
}