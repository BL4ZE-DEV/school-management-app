<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();                  // auto-increment PK
            $table->uuid('tenantId')->unique();  // public UUID
            $table->string('school_name');
            $table->string('location')->nullable();
            $table->string('subdomain')->unique();
            $table->string('database')->unique();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
