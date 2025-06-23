<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pay_reference_name');
            $table->unsignedBigInteger('branch_id');
            $table->string('payroll_number');
            $table->date('pay_period_start_date');
            $table->date('pay_period_end_date');
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
        Schema::dropIfExists('pay_references');
    }
}
