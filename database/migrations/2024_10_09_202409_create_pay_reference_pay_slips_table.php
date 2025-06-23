<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayReferencePaySlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_reference_pay_slips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pay_ref_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('total_working_hours')->nullable();
            $table->string('total_working_days')->nullable();
            $table->string('late_count')->nullable();
            $table->string('late_deduction')->nullable();
            $table->string('sandwich_leave_count')->nullable();
            $table->string('sandwich_leave_deduction')->nullable();
            $table->string('loss_of_pay_days')->nullable();
            $table->string('loss_of_pay_amount')->nullable();
            $table->string('total_payable_amount')->nullable();
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
        Schema::dropIfExists('pay_reference_pay_slips');
    }
}
