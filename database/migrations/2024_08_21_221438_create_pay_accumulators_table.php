<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayAccumulatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_accumulators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pay_accumulator_code')->unique();
            $table->string('pay_accumulator_name');
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
        Schema::dropIfExists('pay_accumulators');
    }
}
