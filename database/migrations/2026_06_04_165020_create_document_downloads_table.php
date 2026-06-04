<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_downloads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('document_id')->constrained('documents')->cascadeOnDelete();

            // NOTE: gunakan foreign key hanya jika tabel parent memang ada.
            // Di repo ini, migration timestamp mungkin menyebabkan urutan eksekusi tidak konsisten.
            // Untuk menghindari error 1824, kita buat validation_id tanpa foreign constraint.
            $table->unsignedBigInteger('validation_id')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // snapshot identity from request
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('institution')->nullable();
            $table->string('position')->nullable();
            $table->json('fields_json')->nullable();

            $table->ipAddress('ip')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('document_downloads');
    }
};

