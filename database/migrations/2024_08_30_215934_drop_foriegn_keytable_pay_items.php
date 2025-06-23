<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForiegnKeytablePayItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_items', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropForeign(['bank_detail_id']);
            $table->dropForeign(['superannuation_fund_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_items', function (Blueprint $table) {
            //
        });
    }
}
