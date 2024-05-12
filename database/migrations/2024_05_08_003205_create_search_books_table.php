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
//            $table->unsignedBigInteger('book_1_id');
//            $table->unsignedBigInteger('book_2_id');
//            $table->unsignedBigInteger('book_3_id');
//            $table->unsignedBigInteger('book_4_id');

            $table->id();
            $table->string('query_image_name');

//            $table->foreign('book_1_id')->references('id')->on('books');
//            $table->foreign('book_2_id')->references('id')->on('books');
//            $table->foreign('book_3_id')->references('id')->on('books');
//            $table->foreign('book_4_id')->references('id')->on('books');
            $table->string('book_1_image_name')->nullable();
            $table->integer('book_1_percentage')->nullable();
            $table->string('book_2_image_name')->nullable();
            $table->integer('book_2_percentage')->nullable();
            $table->string('book_3_image_name')->nullable();
            $table->integer('book_3_percentage')->nullable();
            $table->string('book_4_image_name')->nullable();
            $table->integer('book_4_percentage')->nullable();

            $table->enum('type', [1,2,3]);
            $table->integer('time')->nullable();


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
