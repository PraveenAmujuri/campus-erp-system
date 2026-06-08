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
        Schema::create('staff_attendance', function (Blueprint $table) {

            // Primary key
            $table->id();

            // Staff relation
            $table->foreignId('staff_id')
                ->constrained('staff')
                ->onDelete('cascade');

            // Attendance date
            $table->date('date');

            // Attendance status
            $table->enum(
                'status',
                [
                    'PRESENT',
                    'ABSENT',
                    'HOLIDAY'
                ]
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_attendance');
    }
};