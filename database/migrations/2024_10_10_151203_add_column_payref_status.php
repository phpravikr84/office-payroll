<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPayrefStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_references', function (Blueprint $table) {
            $table->integer('payref_status')
                  ->default(1)
                  ->comment('1 = new, 2 = progress, 3 = complete, 4 = cancel')
                  ->after('pay_period_end_date');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_references', function (Blueprint $table) {
            $table->dropColumn('payref_status');
        });
    }
}
