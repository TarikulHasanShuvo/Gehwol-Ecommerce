<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGiftCertificate extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gift_certificate()
    {
        return $this->belongsTo(GiftCertificate::class);
    }
}
