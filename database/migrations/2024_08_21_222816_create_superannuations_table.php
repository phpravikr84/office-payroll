<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperannuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superannuations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->decimal('employer_contribution_percentage', 5, 2)->nullable();
            $table->decimal('employer_contribution_fixed_amount', 15, 2)->nullable();
            $table->string('tax_method_for_employee_contribution')->nullable();
            $table->boolean('included_bank_transfer')->default(false);
            $table->string('bank_account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_superannuation_no')->nullable();
            $table->date('registration_date')->nullable();
            $table->tinyInteger('status')->default(1); // 1 for Active, 0 for Inactive
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
        Schema::dropIfExists('superannuations');
    }
}
