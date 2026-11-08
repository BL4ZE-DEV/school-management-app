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
            $table->uuid('student_id')->unique();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('dob');

            $table->foreignId('user_id')
                ->constrained('tenant_users')
                ->cascadeOnDelete();

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



// remoevd email from students table because they are already in tenant_users table