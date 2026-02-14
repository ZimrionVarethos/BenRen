<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Car extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'cars';

    protected $fillable = [
        'brand',
        'model',
        'year',
        'license_plate',
        'color',
        'seats',
        'transmission', // manual/automatic
        'fuel_type', // bensin/diesel/electric
        'price_per_day',
        'status', // available/rented/maintenance
        'images', // array of image URLs
        'features', // array of features
        'description',
        'current_location', // untuk tracking (dummy saat ini)
    ];

    protected $casts = [
        'year' => 'integer',
        'seats' => 'integer',
        'price_per_day' => 'float',
        'images' => 'array',
        'features' => 'array',
        'current_location' => 'array',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'car_id');
    }

    public function activeOrder()
    {
        return $this->hasOne(Order::class, 'car_id')
            ->whereIn('status', ['pending', 'confirmed', 'ongoing']);
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->status === 'available';
    }

    public function getFullNameAttribute()
    {
        return "{$this->brand} {$this->model} ({$this->year})";
    }
}