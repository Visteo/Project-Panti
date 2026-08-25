<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('organization_name')
                ->default('Harapan Bangsa');

            $table->string('tagline')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('about')->nullable();
            $table->string('logo')->nullable();

            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('instagram')->nullable();

            $table->string('bca_account_number')->nullable();
            $table->string('bca_account_name')->nullable();

            $table->string('bri_account_number')->nullable();
            $table->string('bri_account_name')->nullable();

            $table->string('mandiri_account_number')->nullable();
            $table->string('mandiri_account_name')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};