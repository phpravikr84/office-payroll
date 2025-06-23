<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_code')->unique();
            $table->string('loan_name');
            $table->unsignedBigInteger('loan_id');
            $table->decimal('loan_amount', 15, 2);
            $table->decimal('balance_amount', 15, 2);
            $table->decimal('amount_to_pay', 15, 2);
            $table->string('reference')->nullable();
            $table->date('repayment_paid_on')->nullable();
            $table->tinyInteger('payment_schedule')->default(1)->comment('1=>Auto, 2=>Manual');
            $table->tinyInteger('payment_status')->default(1)->comment('1=>Success, 2=>Hold, 3=>Failure');
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
        Schema::dropIfExists('loan_payments');
    }
}
