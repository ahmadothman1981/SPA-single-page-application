<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    /** @use HasFactory<\Database\Factories\ListingFactory> */
    use HasFactory , SoftDeletes; 

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
         'price',
         'by_user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class,'by_user_id');
    }

    public function scopeMostRecent(Builder $query)
    {
        return $query->orderByDesc('created_at');
    }
    public  function scopeFilter(Builder $query, array $filters)
    {
        return $query->when($filters['priceFrom'] ?? null, function ($query, $value) {
            return $query->where('price', '>=', (int) $value);
        })
        ->when($filters['priceTo'] ?? null, function ($query, $value) {
            return $query->where('price', '<=', (int) $value);
        })
        ->when($filters['beds'] ?? null, function ($query, $value) {
            $intValue = (int) $value;
            return $query->where('beds', $intValue < 6 ? '=' : '>=', $intValue);
        })
        ->when($filters['baths'] ?? null, function ($query, $value) {
            $intValue = (int) $value;
            return $query->where('baths', $intValue < 6 ? '=' : '>=', $intValue);
        })
        ->when($filters['areaFrom'] ?? null, function ($query, $value) {
            return $query->where('area', '>=', (int) $value);
        })
        ->when($filters['areaTo'] ?? null, function ($query, $value) {
            return $query->where('area', '<=', (int) $value);
        })
        ->when($filters['deleted'] ?? false, function ($query, $value) {
            return $query->withTrashed();
        });
    }
}
