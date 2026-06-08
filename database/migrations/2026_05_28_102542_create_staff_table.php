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
        Schema::create('staff', function (Blueprint $table) {

            $table->id();

            // Staff basic information
            $table->string('name');

            // TEACHING or NON_TEACHING
            $table->enum('type', [
                'TEACHING',
                'NON_TEACHING'
            ]);

            // For teaching staff
            $table->string('subject')->nullable();

            // For non-teaching staff
            $table->string('role')->nullable();

            // Monthly salary
            $table->decimal('salary', 10, 2);

            // Optional contact details
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
        Schema::dropIfExists('staff');
    }
};