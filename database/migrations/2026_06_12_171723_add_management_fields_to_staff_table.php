<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone');
            $table->date('hire_date')->nullable()->after('email');
            $table->string('staff_type')->nullable()->after('hire_date');
            $table->string('status')->default('Active')->after('staff_type');
            $table->text('remark')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'hire_date',
                'staff_type',
                'status',
                'remark'
            ]);
        });
    }
};