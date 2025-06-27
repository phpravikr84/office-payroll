<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('time_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('users')->onDelete('cascade');
            $table->date('log_date');
            $table->time('login_time')->nullable();
            $table->time('logout_time')->nullable();
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->integer('total_work_seconds')->default(0);
            $table->integer('total_break_seconds')->default(0);
            $table->year('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedTinyInteger('day');
            $table->timestamps();
            $table->unique(['employee_id', 'log_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_logs');
    }
};
