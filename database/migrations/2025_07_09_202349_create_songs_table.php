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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->unsignedBigInteger('artist_id')->index()->nullable(); // Foreign key to the artist
            $table->unsignedBigInteger('album_id')->index()->nullable(); // Foreign key to the album, nullable if not part of an album
            $table->string('genre')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->default('')->nullable(); // '0' for valid, '1' for non-valid
            $table->string('data_state')->default('0'); // '0' for active, '1' for deleted
            $table->string('description')->nullable();
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
            // Optional foreign key constraint for album if needed
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('set null')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
