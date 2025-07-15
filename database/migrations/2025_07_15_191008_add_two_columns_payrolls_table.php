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
        Schema::table('payrolls', function (Blueprint $table) {
            $table->unsignedBigInteger('empl_superannuation_id')->nullable()->after('annual_salary'); // adjust position if needed
            $table->decimal('employer_contribution_percentage', 5, 2)->nullable()->after('empl_superannuation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn(['empl_superannuation_id', 'employer_contribution_percentage']);
        });
    }
};
