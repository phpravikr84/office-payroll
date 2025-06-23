<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBankIdBankDetailId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_locations', function (Blueprint $table) {
            $table->integer('bank_id')->after('payroll_location_name')->nullable();
            $table->integer('bank_detail_id')->after('bank_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_locations', function (Blueprint $table) {
            $table->dropColumn('bank_id');
            $table->dropColumn('bank_detail_id');
        });
    }
}
