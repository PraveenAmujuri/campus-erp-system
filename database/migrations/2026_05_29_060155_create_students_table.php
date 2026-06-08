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
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Admission Details
            |--------------------------------------------------------------------------
            */

            $table->string('admission_number')->unique();

            $table->string('name');

            /*
            |--------------------------------------------------------------------------
            | Academic Information
            |--------------------------------------------------------------------------
            */

            $table->string('stream'); // Science / Arts

            $table->string('course'); // BSc, BA, BCom, etc.

            $table->integer('semester');

            /*
            |--------------------------------------------------------------------------
            | Reservation Category
            |--------------------------------------------------------------------------
            */

            $table->enum('category', [
                'GEN',
                'OBC',
                'SC',
                'ST'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};