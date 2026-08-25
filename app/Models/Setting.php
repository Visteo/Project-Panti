<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'tagline',
        'short_description',
        'about',
        'logo',
        'address',
        'email',
        'phone',
        'whatsapp',
        'instagram',
        'bca_account_number',
        'bca_account_name',
        'bri_account_number',
        'bri_account_name',
        'mandiri_account_number',
        'mandiri_account_name',
    ];

    public function getWhatsappUrlAttribute(): ?string
    {
        if (!$this->whatsapp) {
            return null;
        }

        $number = preg_replace(
            '/[^0-9]/',
            '',
            $this->whatsapp
        );

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        return 'https://wa.me/' . $number;
    }
}