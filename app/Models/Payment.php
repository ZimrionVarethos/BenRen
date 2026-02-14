<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
        'order_id',
        'payment_number',
        'amount',
        'payment_method', // bank_transfer, e-wallet, credit_card (dummy)
        'payment_gateway', // midtrans, xendit (dummy untuk saat ini)
        'status', // pending, success, failed, expired
        'payment_proof_url',
        'transaction_id', // ID dari payment gateway (dummy)
        'paid_at',
        'expired_at',
        'metadata', // data tambahan dari payment gateway
    ];

    protected $casts = [
        'amount' => 'float',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'metadata' => 'array',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Helper methods
    public function isPaid()
    {
        return $this->status === 'success';
    }

    public function isExpired()
    {
        if (!$this->expired_at) {
            return false;
        }
        
        return now()->greaterThan($this->expired_at);
    }

    // Generate payment number
    public static function generatePaymentNumber()
    {
        $prefix = 'PAY';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 8));
        
        return "{$prefix}-{$date}-{$random}";
    }
}