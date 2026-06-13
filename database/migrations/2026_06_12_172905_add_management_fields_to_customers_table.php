<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('customer_type')->default('Potential Buyer')->after('address');
            $table->string('interested_vehicle')->nullable()->after('customer_type');
            $table->decimal('budget', 12, 2)->nullable()->after('interested_vehicle');
            $table->string('preferred_payment')->nullable()->after('budget');
            $table->text('note')->nullable()->after('preferred_payment');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'customer_type',
                'interested_vehicle',
                'budget',
                'preferred_payment',
                'note'
            ]);
        });
    }
};