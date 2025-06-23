<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodDefinationRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_defination_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->integer('pay_unit');
            $table->decimal('pays_per_year', 8, 2)->nullable();
            $table->decimal('hours_per_day', 8, 2)->nullable();
            $table->decimal('hours_per_pay', 8, 2)->nullable();
            $table->decimal('days_per_pay', 8, 2)->nullable();
            $table->decimal('rate_per_pay_unit_hours', 8, 2)->nullable();
            $table->decimal('overtime_rate_one', 8, 2)->nullable();
            $table->decimal('overtime_rate_two', 8, 2)->nullable();
            $table->decimal('special_rate_one', 8, 2)->nullable();
            $table->decimal('special_rate_two', 8, 2)->nullable();
        
            // ENUM fields for leave flags with comments
            $table->enum('annual_leave_flag', ['0', '1'])->default('0')->comment('0: False, 1: True')->nullable();
            $table->enum('casual_leave_flag', ['0', '1'])->default('0')->comment('0: False, 1: True')->nullable();
            $table->enum('priviledge_leave_flag', ['0', '1'])->default('0')->comment('0: False, 1: True')->nullable();
        
            $table->string('accurate_type')->nullable();
            $table->decimal('compensate_leave', 8, 2)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('period_defination_rates');
    }
}
