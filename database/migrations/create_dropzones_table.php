<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating the dropzones table to store metadata of temporary uploaded files.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dropzones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // User who owns this uploaded file
            $table->string('disk', 100);                    // Storage disk name
            $table->string('filename', 100);                // Original file name
            $table->unsignedBigInteger('filesize');         // File size in bytes
            $table->string('extension', 10);                // File extension
            $table->string('mimetypes', 100);               // MIME type of file
            $table->string('filepath');                     // Relative file path on disk
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropzones');
    }
};
