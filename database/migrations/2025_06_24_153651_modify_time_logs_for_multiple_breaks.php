<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('time_logs', function (Blueprint $table) {
            $table->json('breaks')->nullable()->after('logout_time');
            $table->dropColumn(['break_start', 'break_end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_logs', function (Blueprint $table) {
            $table->time('break_start')->nullable()->after('logout_time');
            $table->time('break_end')->nullable()->after('break_start');
            $table->dropColumn('breaks');
        });
    }
};
