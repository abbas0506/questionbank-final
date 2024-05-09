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
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subtype_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable()->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger('approver_id')->nullable();
            $table->string('statement', 500)->nullable();
            $table->unsignedTinyInteger('exercise_no')->nullable();
            $table->unsignedTinyInteger('frequency');
            $table->unsignedTinyInteger('marks');
            $table->boolean('is_conceptual')->default(false);
            $table->date('approved_at')->nullable();
            // $table->boolean('is_approved');
            $table->foreign('approver_id')->references('id')->on('users')->cascadeOnDelete();
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
