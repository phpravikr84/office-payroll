<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeBankRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_bank_rels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('emp_id'); // Foreign key for employee
            $table->unsignedBigInteger('bank_id'); // Foreign key for bank
            $table->string('account_no')->unique(); // Unique bank account number
            $table->string('bank_code')->nullable(); // Bank code
            $table->string('ifsc_code')->nullable(); // IFSC code for Indian banks
            $table->string('swift_code')->nullable(); // SWIFT code for international transactions
            $table->string('account_holder_name'); // Name of the account holder
            $table->string('address')->nullable(); // Address of the account holder
            $table->string('city')->nullable(); // City of the account holder
            $table->string('state')->nullable(); // State of the account holder
            $table->string('branch_name')->nullable(); // Bank branch name
            $table->string('email_address')->nullable(); // Email address of the account holder
            $table->string('country_code')->nullable(); // Country code
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
        Schema::dropIfExists('employee_bank_rels');
    }
}
