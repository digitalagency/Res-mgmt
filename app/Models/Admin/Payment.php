<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    const PAID = 1;
    const UNPAID = 0;

    protected $fillable = [
        'order_id',
        'net_price',
        'vat',
        'gross_price',
        'payment_status'
    ];

    public function isPaid()
    {
        return $this->payment_status = Payment::PAID;
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
