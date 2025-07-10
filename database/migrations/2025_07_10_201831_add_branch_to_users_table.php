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
        Schema::table('users', function (Blueprint $table) {
            $table->string('branch')->nullable()->after('end_date');
            // Optional: Add an index if you frequently query by branch
            // $table->index('branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('branch');
            // Optional: Drop the index if it was created
            // $table->dropIndex(['branch']);
        });
    }
};
