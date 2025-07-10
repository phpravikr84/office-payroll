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
        Schema::create('employee_cost_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('cost_center_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->decimal('share_percentage', 5, 2)->nullable();
            $table->unsignedBigInteger('payroll_location_id')->nullable();
            $table->unsignedBigInteger('payroll_batch_id')->nullable();
            $table->timestamps();

            // Optional: Add foreign key constraints if needed
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            // $table->foreign('cost_center_id')->references('id')->on('cost_centers')->onDelete('set null');
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            // $table->foreign('payroll_location_id')->references('id')->on('locations')->onDelete('set null');
            // $table->foreign('payroll_batch_id')->references('id')->on('payroll_batches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_cost_centers');
    }
};
