<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'review',
        'review_date',
        'rating',
        'image',
        'enabled',
    ];

    protected $casts = [
        'review_date' => 'date:Y-m-d',
    ];
}
