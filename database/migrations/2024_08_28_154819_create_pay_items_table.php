<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();  // Corrected typo here
            $table->string('name')->nullable();
            $table->unsignedInteger('accumulator')->nullable();
            $table->unsignedInteger('glaccount')->nullable();
            $table->decimal('tax_rate', 8, 2)->nullable();
            $table->string('spread_code')->nullable();
            $table->string('taxflag')->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->integer('bank_detail_id')->nullable();
            $table->unsignedInteger('superannuation_fund_id')->nullable();
            $table->string('payment_mode')->nullable();
            $table->decimal('fixed_amount', 8, 2)->nullable();
            $table->decimal('percentage', 8, 2)->nullable();
            $table->string('sequence')->nullable();
            $table->enum('will_accure_leave', ['0', '1'])->default('1')->comment('0: No, 1: Yes')->nullable();
            $table->timestamps();
        
            // Foreign keys
            $table->foreign('accumulator')->references('id')->on('pay_accumulators')->onDelete('cascade');
            $table->foreign('glaccount')->references('id')->on('gl_codes')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('bank_detail_id')->references('id')->on('bank_details')->onDelete('cascade');
            $table->foreign('superannuation_fund_id')->references('id')->on('superannuations')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_items');
    }
}
