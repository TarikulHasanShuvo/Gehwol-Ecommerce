<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','order_uid','is_payment_completed','status','gst','discount','shipping_charge',
        'total','order_date','shipping_method','shipped_date','ship_first_name','ship_last_name','ship_business_name',
        'ship_address_line_1','ship_address_line_2','ship_postal_code','ship_city','ship_state','ship_country','ship_phone'
    ,'comments'];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_payment_completed', 1);
    }

    public function gift_certificates()
    {
        return $this->hasMany(OrderGiftCertificate::class);
    }
}
