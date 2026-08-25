<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->text('snap_token')
                ->nullable()
                ->after('payment_reference');

            $table->text('snap_redirect_url')
                ->nullable()
                ->after('snap_token');

            $table->timestamp('payment_expired_at')
                ->nullable()
                ->after('paid_at');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'snap_token',
                'snap_redirect_url',
                'payment_expired_at',
            ]);
        });
    }
};