<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayReferenceUpdateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_reference_update_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pay_reference_id'); // Foreign key to the pay reference table
            $table->unsignedBigInteger('loan_id'); // Foreign key to the loan table
            $table->unsignedBigInteger('user_id'); // Foreign key to the user (employee)
            $table->string('loan_name'); // Loan name
            $table->unsignedBigInteger('loan_master_id'); // Foreign key to loan master
            $table->date('loan_date'); // Date the loan was given
            $table->date('deduction_start_date'); // Date when deductions start
            $table->decimal('deduction_amount', 10, 2); // Deduction amount (up to 2 decimal places)
            $table->decimal('outstanding_amount', 10, 2); // Outstanding amount (up to 2 decimal places)
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
        Schema::dropIfExists('pay_reference_update_loans');
    }
}
