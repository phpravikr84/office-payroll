<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpacSettingBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpac_setting_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wpac_setting_id')->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->timestamps();

            $table->foreign('wpac_setting_id')->references('id')->on('wpac_bank_transfer_setups')->onDelete('cascade');
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
        Schema::dropIfExists('wpac_setting_banks');
    }
}
