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
        Schema::create('classified_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('website')->nullable();
            $table->string('user_name');
            $table->string('email')->nullable();
            $table->string('password');  
            $table->string('profile_url')->nullable();
            $table->enum('status', ['un-public', 'public'])->default('un-public');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classified_profile');
    }
};
