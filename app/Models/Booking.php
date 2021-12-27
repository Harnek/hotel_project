<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'room_id',
        'category_id',
        'customer_id',
        'order_id',
        'check_in',
        'check_out',
        'guests',
        'notes',
        'cancelled',
    ];

    protected $casts = [
        'check_in' => 'date:Y-m-d',
        'check_out' => 'date:Y-m-d',
    ];
}
