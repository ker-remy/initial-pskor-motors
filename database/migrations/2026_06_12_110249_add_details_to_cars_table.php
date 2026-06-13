<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('color')->nullable()->after('year');
            $table->integer('mileage')->nullable()->after('color');
            $table->string('engine_number')->nullable()->after('mileage');
            $table->string('frame_number')->nullable()->after('engine_number');
            $table->string('transmission')->nullable()->after('frame_number');
            $table->string('fuel_type')->nullable()->after('transmission');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'color',
                'mileage',
                'engine_number',
                'frame_number',
                'transmission',
                'fuel_type'
            ]);
        });
    }
};