<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLoanDeductionInstallment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_reference_pay_slips', function (Blueprint $table) {
            $table->decimal('loan_deduction_installment', 8, 2)->after('total_taxable_deduct_wdays')->nullable();
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
            $table->dropColumn('loan_deduction_installment');
        });
    }
}
