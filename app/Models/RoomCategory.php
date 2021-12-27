<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price1',
        'price2',
        'price3',
        'price4',
        'adults',
        'children',
        'image',
        'enabled',
    ];
}
