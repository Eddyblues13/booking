<?php
// Booking.php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_reference',
        'user_id',
        'flight_id',
        'passenger_count',
        'total_amount',
        'base_fare',
        'taxes',
        'service_fee',
        'contact_email',
        'contact_phone',
        'contact_phone_secondary',
        'emergency_contact_name',
        'emergency_contact_phone',
        'special_requests',
        'status',
        'payment_status',
        'payment_method',
        'cancelled_at',
        'cancellation_reason',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'base_fare' => 'decimal:2',
        'taxes' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getFormattedTotalAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed' && $this->payment_status === 'completed';
    }

    public function isPendingPayment()
    {
        return $this->status === 'pending_payment' && $this->payment_status === 'pending';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'AT-' . strtoupper(Str::random(6)) . '-' . date('Ymd');
            }
        });
    }
}
