<?php

return [
    'bank_accounts' => [
        'bca' => [
            'name' => 'BCA',
            'account_number' => env(
                'DONATION_BCA_ACCOUNT',
                '0000000000'
            ),
            'account_name' => env(
                'DONATION_BCA_NAME',
                'Yayasan Harapan Bangsa'
            ),
        ],

        'bri' => [
            'name' => 'BRI',
            'account_number' => env(
                'DONATION_BRI_ACCOUNT',
                '0000000000'
            ),
            'account_name' => env(
                'DONATION_BRI_NAME',
                'Yayasan Harapan Bangsa'
            ),
        ],

        'mandiri' => [
            'name' => 'Mandiri',
            'account_number' => env(
                'DONATION_MANDIRI_ACCOUNT',
                '0000000000'
            ),
            'account_name' => env(
                'DONATION_MANDIRI_NAME',
                'Yayasan Harapan Bangsa'
            ),
        ],
    ],
];