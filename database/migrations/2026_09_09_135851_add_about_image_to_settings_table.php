<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_image')
                ->nullable()
                ->after('logo');

            $table->string('about_image')
                ->nullable()
                ->after('hero_image');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image',
                'about_image',
            ]);
        });
    }
};