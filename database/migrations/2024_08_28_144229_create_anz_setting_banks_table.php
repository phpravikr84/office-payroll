<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnzSettingBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anz_setting_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('anz_setting_id')->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->timestamps();

            $table->foreign('anz_setting_id')->references('id')->on('anz_bank_transfer_setups')->onDelete('cascade');
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
        Schema::dropIfExists('anz_setting_banks');
    }
}
