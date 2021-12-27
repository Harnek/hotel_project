<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_status',
        'order_created',
        'payment_method',
        'payment_status',
        'currency',
        'total',
        'txn_id',
        'resp_msg',
        'cancelled',
        'cancel_msg',
        'fail_msg',

        'category_id',
        'check_in',
        'check_out',
        'rooms',
        'guests',
        'notes',
        
        'price',
        'discount',
        'tax_percentage',
        'tax',
        'amount',

        'customer_id',
    ];

    protected $casts = [
        'order_created' => 'date:Y-m-d',
        'category_id' => 'array',
        'check_in' => 'date:Y-m-d',
        'check_out' => 'date:Y-m-d',
    ];
}
