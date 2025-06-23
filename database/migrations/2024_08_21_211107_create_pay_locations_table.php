<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payroll_location_code')->unique();
            $table->string('payroll_location_name');
            $table->tinyInteger('status')->default(1); // 1 for Published, 0 for Unpublished
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
        Schema::dropIfExists('pay_locations');
    }
}
