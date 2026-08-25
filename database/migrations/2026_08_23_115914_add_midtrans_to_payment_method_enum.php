<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE donations
            MODIFY payment_method ENUM(
                'bank_transfer',
                'qris',
                'virtual_account',
                'ewallet',
                'midtrans'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE donations
            MODIFY payment_method ENUM(
                'bank_transfer',
                'qris',
                'virtual_account',
                'ewallet'
            ) NOT NULL
        ");
    }
};