<?php

namespace App\Services;

use App\Models\Donation;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = (bool) config(
            'midtrans.is_production'
        );
        Config::$isSanitized = (bool) config(
            'midtrans.is_sanitized'
        );
        Config::$is3ds = (bool) config(
            'midtrans.is_3ds'
        );
    }

    public function createTransaction(Donation $donation): array
    {
        $params = [
            'transaction_details' => [
                'order_id' => $donation->invoice_number,
                'gross_amount' => (int) $donation->amount,
            ],

            'item_details' => [
                [
                    'id' => 'CAMPAIGN-' . $donation->campaign_id,
                    'price' => (int) $donation->amount,
                    'quantity' => 1,
                    'name' => substr(
                        $donation->campaign->title,
                        0,
                        50
                    ),
                ],
            ],

            'customer_details' => [
                'first_name' => $donation->donor_name,
                'email' => $donation->donor_email,
                'phone' => $donation->donor_phone,
            ],

            'expiry' => [
                'unit' => 'hours',
                'duration' => 24,
            ],
        ];

        $transaction = Snap::createTransaction($params);

        return [
            'token' => $transaction->token,
            'redirect_url' => $transaction->redirect_url,
        ];
    }
}