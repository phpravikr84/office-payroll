<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('leave_category_id');
            $table->string('leave_type');
            $table->string('leave_option')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason')->nullable();
            $table->integer('loss_of_pay_days')->default(0);
            $table->decimal('pending_leave', 5, 2)->default(0);
            $table->tinyInteger('status')->default(0); // 0: pending, 1: approved, 2: canceled, 3: rejected
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('leave_category_id')->references('id')->on('leave_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_managements');
    }
}
