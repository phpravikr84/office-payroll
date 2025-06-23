<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gl_code')->unique();
            $table->string('gl_name');
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
        Schema::dropIfExists('gl_codes');
    }
}
