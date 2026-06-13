<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('body_type')->nullable()->after('fuel_type');
            $table->string('condition')->default('Used')->after('body_type');
            $table->text('remark')->nullable()->after('condition');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'body_type',
                'condition',
                'remark'
            ]);
        });
    }
};