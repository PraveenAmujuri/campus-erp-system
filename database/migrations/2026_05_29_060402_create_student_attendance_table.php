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
        Schema::create('student_attendance', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Student Relationship
            |--------------------------------------------------------------------------
            |
            | Each attendance record belongs to one student.
            |
            */

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | Attendance Information
            |--------------------------------------------------------------------------
            */

            $table->date('date');

            $table->enum('status', [
                'PRESENT',
                'ABSENT',
                'HOLIDAY'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendance');
    }
};