<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id')->nullable(); // Nullable employee_id
            $table->string('employee_name')->nullable();
            $table->string('attendance_date', 255)->nullable(); // Nullable and string type attendance_date
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->decimal('work_time', 8, 2)->nullable();
            $table->decimal('late', 8, 2)->default(0.00);
            $table->decimal('early', 8, 2)->default(0.00);
            $table->boolean('absence')->default(0);
            $table->string('absence_type')->nullable();
            $table->unsignedBigInteger('leave_id')->nullable();
            $table->unsignedBigInteger('leave_category_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('leave_status')->nullable();
            $table->text('leave_reason')->nullable();
            $table->tinyInteger('late_count_flag')->nullable();
            $table->unsignedBigInteger('holiday_id')->nullable();
            $table->boolean('is_holiday')->default(0);
            $table->unsignedBigInteger('working_days_id')->nullable();
            $table->decimal('working_hours', 8, 2)->nullable();
            $table->string('working_day_name')->nullable();
            $table->decimal('paid_hours', 8, 2)->nullable();
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
        Schema::dropIfExists('attendance_reports');
    }
}
