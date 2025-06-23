<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryDaysCountToPeriodDefinationRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('period_defination_rates', function (Blueprint $table) {
            $table->integer('salary_days_count')->after('compensate_leave')->nullable(); // Adjust type and attributes as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('period_defination_rates', function (Blueprint $table) {
            $table->dropColumn('salary_days_count');
        });
    }
}
