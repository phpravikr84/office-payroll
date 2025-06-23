<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNameKinaBankTransferSetups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kina_bank_transfer_setups', function (Blueprint $table) {
            $table->dropColumn('anz_customer_reference');
            $table->dropColumn('anz_folder_directory');
            $table->string('kina_customer_reference')->after('id')->nullable();
            $table->string('kina_folder_directory')->after('kina_customer_reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kina_bank_transfer_setups', function (Blueprint $table) {
            //
        });
    }
}
