<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_validations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('document_id')->constrained('documents')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('institution')->nullable();
            $table->string('position')->nullable();

            // For extra/dynamic fields defined by admin
            $table->json('fields_json')->nullable();

            // since requirement: direct download after form, we mark completed
            $table->string('status')->default('completed'); // completed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_validations');
    }
};

