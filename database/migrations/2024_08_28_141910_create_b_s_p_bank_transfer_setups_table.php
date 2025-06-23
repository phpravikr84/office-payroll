<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBSPBankTransferSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsp_bank_transfer_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bsp_customer_reference')->nullable();
            $table->string('bsp_folder_directory')->nullable();
            $table->integer('gl_account_code')->nullable();
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
        Schema::dropIfExists('b_s_p_bank_transfer_setups');
    }
}
