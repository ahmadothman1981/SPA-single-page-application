<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    /** @use HasFactory<\Database\Factories\ListingFactory> */
    use HasFactory;

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'price',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'description',
        'code',
        'street',
        'street_nr',
    ];
}
