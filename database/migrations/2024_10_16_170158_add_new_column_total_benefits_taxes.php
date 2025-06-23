<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnTotalBenefitsTaxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_reference_pay_slips', function (Blueprint $table) {
            $table->unsignedBigInteger('total_benefits_payable')->after('meals_allowance')->default(0)->nullable();
            $table->unsignedBigInteger('total_taxable_deduct_wdays')->after('total_benefits_payable')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_reference_pay_slips', function (Blueprint $table) {
            $table->dropColumn('total_benefits_payable');
            $table->dropColumn('total_taxable_deduct_wdays');
        });
    }
}
