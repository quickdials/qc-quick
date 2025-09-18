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
        Schema::create('seo_works', function (Blueprint $table) {
            $table->id();
            $table->string('keyword')->index();            
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('backlink')->nullable();
            $table->string('index_status')->nullable();
            $table->string('index_value')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            // Foreign key constraints
           
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_works');
    }
};
