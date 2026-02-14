<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'order_number',
        'customer_id',
        'car_id',
        'driver_id',
        'start_date',
        'end_date',
        'pickup_location',
        'return_location',
        'total_days',
        'price_per_day',
        'total_price',
        'status', // pending, confirmed, ongoing, completed, cancelled
        'payment_status', // unpaid, paid, refunded
        'payment_method', // dummy untuk saat ini
        'payment_proof', // URL to payment proof
        'driver_confirmed', // boolean
        'notes',
        'cancellation_reason',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'total_days' => 'integer',
        'price_per_day' => 'float',
        'total_price' => 'float',
        'driver_confirmed' => 'boolean',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    // Helper methods
    public function getRemainingTimeAttribute()
    {
        if ($this->status !== 'ongoing') {
            return null;
        }

        $now = Carbon::now();
        $endDate = Carbon::parse($this->end_date);

        if ($now->greaterThan($endDate)) {
            return 'Overtime';
        }

        return $now->diff($endDate)->format('%d hari %h jam %i menit');
    }

    public function isActive()
    {
        return in_array($this->status, ['pending', 'confirmed', 'ongoing']);
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }

    // Generate order number
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        
        return "{$prefix}-{$date}-{$random}";
    }
}