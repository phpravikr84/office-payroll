<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateANZBankTransferSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anz_bank_transfer_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anz_customer_reference')->nullable();
            $table->string('anz_folder_directory')->nullable();
            $table->integer('gl_code_id')->nullable();
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
        Schema::dropIfExists('a_n_z_bank_transfer_setups');
    }
}
