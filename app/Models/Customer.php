<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'street_address',
        'postal_code',
        'city',
        'state_province',
        'country_name',
    ];
}
