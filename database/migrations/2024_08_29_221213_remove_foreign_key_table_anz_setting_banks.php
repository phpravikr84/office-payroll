<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveForeignKeyTableAnzSettingBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anz_setting_banks', function (Blueprint $table) {
             // Remove foreign key constraints if they exist
             $table->dropForeign(['anz_setting_id']);
             $table->dropForeign(['bank_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anz_setting_banks', function (Blueprint $table) {
            //
        });
    }
}
