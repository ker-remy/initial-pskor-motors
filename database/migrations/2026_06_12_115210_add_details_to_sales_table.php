<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('sale_number')->nullable()->after('id');
            $table->string('payment_method')->nullable()->after('total_price');
            $table->text('remarks')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'sale_number',
                'payment_method',
                'remarks'
            ]);
        });
    }
};