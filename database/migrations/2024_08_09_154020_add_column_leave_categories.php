<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLeaveCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_categories', function (Blueprint $table) {
            $table->string('item')->after('leave_category')->nullable();
            $table->integer('qty')->after('item')->nullable();
            $table->string('remarks')->after('qty')->nullable();
            $table->string('type_of_leave')->after('remarks')->comments('carry_forward', 'paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_categories', function (Blueprint $table) {
            $table->dropColumn('item');
            $table->dropColumn('qty');
            $table->dropColumn('remarks');
            $table->dropColumn('type_of_leave');
        });
    }
}
