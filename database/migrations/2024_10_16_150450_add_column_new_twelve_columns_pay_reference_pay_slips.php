<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNewTwelveColumnsPayReferencePaySlips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_reference_pay_slips', function (Blueprint $table) {
            $table->integer('house_rent_allowance')->after('loss_of_pay_amount')->default(0)->nullable();
            $table->integer('medical_allowance')->after('house_rent_allowance')->default(0)->nullable();
            $table->integer('special_allowance')->after('medical_allowance')->default(0)->nullable();
            $table->integer('other_allowance')->after('special_allowance')->default(0)->nullable();
            $table->integer('electricity_allowance')->after('other_allowance')->default(0)->nullable();
            $table->integer('security_allowance')->after('electricity_allowance')->default(0)->nullable();
            $table->integer('tax_deduction_a')->after('security_allowance')->default(0)->nullable();
            $table->integer('hra_type')->after('tax_deduction_a')->default(0)->nullable();
            $table->integer('va_type')->after('hra_type')->default(0)->nullable();
            $table->integer('vechile_allowance')->after('va_type')->default(0)->nullable();
            $table->integer('meal_tag')->after('vechile_allowance')->default(0)->nullable();
            $table->integer('meals_allowance')->after('meal_tag')->default(0)->nullable();
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
            $table->dropColumn('house_rent_allowance');
            $table->dropColumn('medical_allowance');
            $table->dropColumn('special_allowance');
            $table->dropColumn('other_allowance');
            $table->dropColumn('electricity_allowance');
            $table->dropColumn('security_allowance');
            $table->dropColumn('tax_deduction_a');
            $table->dropColumn('hra_type');
            $table->dropColumn('va_type');
            $table->dropColumn('vechile_allowance');
            $table->dropColumn('meal_tag');
            $table->dropColumn('meals_allowance');
        });
    }
}
