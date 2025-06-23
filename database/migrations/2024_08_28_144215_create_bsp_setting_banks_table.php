<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBspSettingBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsp_setting_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bsp_setting_id')->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->timestamps();
        
            $table->foreign('bsp_setting_id')->references('id')->on('bsp_bank_transfer_setups')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bsp_setting_banks');
    }
}
