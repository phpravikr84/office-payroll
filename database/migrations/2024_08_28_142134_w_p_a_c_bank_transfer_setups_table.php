<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WPACBankTransferSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpac_bank_transfer_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wpac_customer_reference')->nullable();
            $table->string('wpac_folder_directory')->nullable();
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
        Schema::dropIfExists('wpac_bank_transfer_setups');
    }
}
