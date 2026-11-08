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
        if(!Schema::connection('tenant')->hasTable('fee_structures')){
            Schema::create('fee_structures', function (Blueprint $table) {
                $table->id();
                $table->foreignId('academic_session_id')->constrained('academic_sessions','id');
                $table->foreignId('school_class_id')->constrained('school_classes', 'id');
                $table->foreignId('term_id')->constrained('terms', 'id');
                $table->decimal('amount',8,2);
                $table->string('description');
                $table->unique(['academic_session_id','school_class_id','term_id'], 'fee_structures_session_class_term_unique');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
