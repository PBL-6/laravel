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
        Schema::create('search_books', function (Blueprint $table) {
            $table->id();
            $table->string('query_image');
            $table->integer('book_1_match')->nullable();
            $table->string('book_1_image')->nullable();
            $table->integer('book_2_match')->nullable();
            $table->string('book_2_image')->nullable();
            $table->integer('book_3_match')->nullable();
            $table->string('book_3_image')->nullable();
            $table->integer('book_4_match')->nullable();
            $table->string('book_4_image')->nullable();
            $table->float('response_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_books');
    }
};
