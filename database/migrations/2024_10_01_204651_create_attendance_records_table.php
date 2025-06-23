<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id');              // Employee ID
            $table->string('employee_name');            // Employee Name
            $table->string('department');               // Department
            $table->date('date');                       // Attendance Date
            $table->time('in_time')->nullable();        // Check-in Time
            $table->time('out_time')->nullable();       // Check-out Time
            $table->string('work_time', 10)->nullable();// Work Time (formatted as string, e.g., "9 hrs 15 mins")
            $table->decimal('overtime_hours', 8, 2)->default(0); // Overtime hours in decimal format
            $table->time('shift_in')->nullable();       // Shift Start Time
            $table->time('shift_out')->nullable();      // Shift End Time
            $table->decimal('late', 8, 2)->default(0);  // Late hours in decimal format
            $table->decimal('early', 8, 2)->default(0); // Early leave hours in decimal format
            $table->boolean('absence')->default(0);     // Absence flag (1 if absent, 0 otherwise)
            $table->string('attendance_status');        // Attendance Status (e.g., "Present", "Absent")
            $table->string('remarks')->nullable();      // Additional remarks, optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_records');
    }
}
