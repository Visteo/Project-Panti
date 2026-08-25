<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('campaign_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('invoice_number')->unique();
            $table->string('donor_name');
            $table->string('donor_email')->nullable();
            $table->string('donor_phone')->nullable();

            $table->decimal('amount', 15, 2);
            $table->text('message')->nullable();
            $table->boolean('is_anonymous')->default(false);

            $table->enum('payment_method', [
                'bank_transfer',
                'qris',
                'virtual_account',
                'ewallet'
            ]);

            $table->string('payment_channel')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('payment_reference')->nullable();

            $table->enum('payment_status', [
                'pending',
                'waiting_verification',
                'paid',
                'failed',
                'expired',
                'cancelled'
            ])->default('pending');

            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};