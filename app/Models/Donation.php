<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'invoice_number',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'message',
        'is_anonymous',
        'payment_method',
        'payment_channel',
        'payment_proof',
        'payment_reference',
        'payment_status',
        'paid_at',
        'snap_token',
        'snap_redirect_url',
        'payment_expired_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_anonymous' => 'boolean',
            'paid_at' => 'datetime',
            'payment_expired_at' => 'datetime',
        ];
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->is_anonymous
            ? 'Hamba Allah'
            : $this->donor_name;
    }
}