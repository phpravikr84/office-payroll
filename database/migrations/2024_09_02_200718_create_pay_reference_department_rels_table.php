<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayReferenceDepartmentRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_reference_department_rels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pay_reference_id');
            $table->unsignedInteger('pay_reference_department_id');
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
        Schema::dropIfExists('pay_reference_department_rels');
    }
}
