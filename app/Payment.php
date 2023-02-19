<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount', 'discount', 'user_id', 'paypal_id', 'status', 'order_start', 'order_details', 'order_complete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
