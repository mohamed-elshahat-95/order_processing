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
        Schema::table('users', function (Blueprint $table) {
            // Add the new 'type' field to the users table
            $table->string('username');
            $table->string('avatar');
            $table->boolean('is_active')->default(true);
            $table->enum('type', ['normal', 'silver', 'gold'])->default('normal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the 'type' field if the migration is rolled back
            $table->dropColumn('type');
        });
    }
};
