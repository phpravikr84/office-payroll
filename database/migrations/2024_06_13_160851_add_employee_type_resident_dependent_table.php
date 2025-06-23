<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeTypeResidentDependentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('employee_type')->comment('1 for Provision & 2 for Permanent')->after('date_of_leaving');
            $table->string('resident_status')->comment('1 for Resident & 2 for Non-Resident')->after('employee_type');
            $table->integer('no_of_dependent')->after('resident_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('employee_type');
            $table->dropColumn('resident_status');
            $table->dropColumn('no_of_dependent');
        });
    }
}
