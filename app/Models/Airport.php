<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'city',
        'country',
        'timezone',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function departingFlights()
    {
        return $this->hasMany(Flight::class, 'departure_airport_id');
    }

    public function arrivingFlights()
    {
        return $this->hasMany(Flight::class, 'arrival_airport_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'LIKE', "%{$term}%")
                ->orWhere('name', 'LIKE', "%{$term}%")
                ->orWhere('city', 'LIKE', "%{$term}%")
                ->orWhere('country', 'LIKE', "%{$term}%");
        });
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return "{$this->name} ({$this->code})";
    }

    public function getCityCountryAttribute()
    {
        return "{$this->city}, {$this->country}";
    }
}
