<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_locations', function (Blueprint $table) {
            $table->integer('male_count')->default(0)->after('description');
            $table->integer('female_count')->default(0)->after('male_count');
            $table->integer('active_count')->default(0)->after('female_count');
            $table->integer('alumni_count')->default(0)->after('active_count');
        });
    }

    public function down(): void
    {
        Schema::table('student_locations', function (Blueprint $table) {
            $table->dropColumn(['male_count', 'female_count', 'active_count', 'alumni_count']);
        });
    }
};
