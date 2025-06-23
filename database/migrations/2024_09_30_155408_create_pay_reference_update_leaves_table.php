<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayReferenceUpdateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_reference_update_leaves', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('pay_reference_id')->nullable();
            $table->integer('employee_id')->nullable();      
            $table->integer('total_loss_of_pay_days')->nullable();
            $table->integer('total_sandwich_leave')->nullable();  
            $table->integer('total_sandwich_leave_days')->nullable();
            $table->integer('total_holiday_count')->nullable(); 
            $table->integer('total_leave_applied_days')->nullable();
            $table->integer('total_pending_leave')->nullable();  
            $table->integer('total_leave_cancel_days')->nullable();
            $table->integer('total_leave_disapprove_days')->nullable();
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
        Schema::dropIfExists('pay_reference_update_leaves');
    }
}
