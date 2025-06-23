<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayReferencePayLocationRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_reference_pay_location_rels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pay_reference_id');
            $table->unsignedInteger('pay_reference_pay_location_id');
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
        Schema::dropIfExists('pay_reference_pay_location_rels');
    }
}
