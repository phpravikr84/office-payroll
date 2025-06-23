<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNewTableLoans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->integer('loan_master_id')->after('loan_description')->nullable();
            $table->date('loan_date')->after('loan_master_id')->nullable();
            $table->date('deduction_start_date')->after('loan_date')->nullable();
            $table->string('deduction_amount')->after('deduction_start_date')->nullable();
            $table->string('outstanding_amount')->after('deduction_amount')->nullable();
            $table->tinyInteger('loan_status')->after('outstanding_amount')->default(1)->comment('1 = active, 2 = onhold, 3 = close');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('loan_date');
            $table->dropColumn('deduction_start_date');
            $table->dropColumn('deduction_amount');
            $table->dropColumn('outstanding_amount');
            $table->dropColumn('loan_status');
        });
    }
}
