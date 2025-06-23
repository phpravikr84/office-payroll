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
        Schema::create('cost_center_department_rel', function (Blueprint $table) {
            $table->id();

            // Foreign key for cost_center
            $table->unsignedBigInteger('cost_center_id')->index();
            $table->foreign('cost_center_id')
                  ->references('id')->on('cost_centers')
                  ->onDelete('cascade');

            // Foreign key for department
            $table->unsignedInteger('department_id')->index();
            $table->foreign('department_id')
                  ->references('id')->on('departments')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_center_department_rel');
    }
};
