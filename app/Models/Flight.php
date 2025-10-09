<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'flight_number',
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'class',
        'price',
        'total_seats',
        'available_seats',
        'aircraft_type',
        'status'
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('available_seats', '>', 0)
            ->where('departure_time', '>', now())
            ->where('status', 'scheduled');
    }

    public function scopeSearch($query, $filters)
    {
        return $query->when(isset($filters['from']), function ($q) use ($filters) {
            $q->whereHas('departureAirport', function ($airportQuery) use ($filters) {
                $airportQuery->where(function ($subQuery) use ($filters) {
                    $subQuery->where('city', 'LIKE', "%{$filters['from']}%")
                        ->orWhere('code', 'LIKE', "%{$filters['from']}%")
                        ->orWhere('name', 'LIKE', "%{$filters['from']}%");
                });
            });
        })
            ->when(isset($filters['to']), function ($q) use ($filters) {
                $q->whereHas('arrivalAirport', function ($airportQuery) use ($filters) {
                    $airportQuery->where(function ($subQuery) use ($filters) {
                        $subQuery->where('city', 'LIKE', "%{$filters['to']}%")
                            ->orWhere('code', 'LIKE', "%{$filters['to']}%")
                            ->orWhere('name', 'LIKE', "%{$filters['to']}%");
                    });
                });
            })
            ->when(isset($filters['date']), function ($q) use ($filters) {
                $date = Carbon::parse($filters['date']);
                $q->whereDate('departure_time', $date->format('Y-m-d'));
            })
            ->when(isset($filters['class']), function ($q) use ($filters) {
                $q->where('class', $filters['class']);
            });
    }

    // Accessors
    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        return sprintf('%dh %dm', $hours, $minutes);
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }
}
