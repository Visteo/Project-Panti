<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'created_by',
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'target_amount',
        'start_date',
        'end_date',
        'status',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function paidDonations()
    {
        return $this->hasMany(Donation::class)
            ->where('payment_status', 'paid');
    }

    public function getCollectedAmountAttribute()
    {
        return $this->paidDonations()->sum('amount');
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_amount <= 0) {
            return 0;
        }

        return min(
            ($this->collected_amount / $this->target_amount) * 100,
            100
        );
    }
}