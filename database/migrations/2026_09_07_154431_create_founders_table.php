<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('founders', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);

            $table->string('position', 150)
                ->nullable();

            $table->text('biography')
                ->nullable();

            $table->string('photo')
                ->nullable();

            $table->year('joined_year')
                ->nullable();

            $table->string('instagram_url')
                ->nullable();

            $table->string('linkedin_url')
                ->nullable();

            $table->unsignedInteger('display_order')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'is_active',
                'display_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('founders');
    }
};