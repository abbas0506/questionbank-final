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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('subtype_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable()->constrained()->cascadeOnDelete();

            $table->unsignedTinyInteger('chapter_no')->nullable();
            $table->unsignedTinyInteger('exercise_no')->nullable();

            $table->string('statement', 300)->nullable();
            $table->unsignedTinyInteger('marks');
            $table->unsignedTinyInteger('bise_frequency');
            $table->boolean('is_conceptual');
            $table->boolean('is_approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
