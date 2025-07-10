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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->unsignedBigInteger('artist_id')->nullable(); // Foreign key to the artist
            $table->string('release_date')->nullable(); // Optional release date for the album
            $table->string('genre')->nullable(); // Optional genre for the album
            $table->string('description')->nullable(); // Optional description for the album
            $table->string('status')->default('')->nullable(); // 'active', 'inactive'
            $table->string('data_state')->default('0'); // '0' for active, '1' for deleted
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
