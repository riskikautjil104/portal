<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            // Storage file reference
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->string('file_type'); // pdf,image,excel,word,other
            $table->string('file_mime')->nullable();

            $table->boolean('active')->default(true);

            // Validation requirement toggle
            $table->boolean('requires_validation')->default(false);
            $table->json('validation_fields_json')->nullable();

            // optional counter cache
            $table->unsignedInteger('download_total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

