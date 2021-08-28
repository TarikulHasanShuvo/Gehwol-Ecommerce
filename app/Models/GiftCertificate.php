<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCertificate extends Model
{
//    protected $hidden = [
//        'gift_card_code'
//    ];

    public function scopePaid($query)
    {
        return $query->where('is_payment_completed', 1);
    }
}
