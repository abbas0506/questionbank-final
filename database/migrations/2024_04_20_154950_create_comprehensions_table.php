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
        Schema::create('comprehensions', function (Blueprint $table) {
            $table->id();
            $table->string('question_a', 100);
            $table->string('question_b', 100)->nullable();
            $table->string('question_c', 100)->nullable();
            $table->string('question_d', 100)->nullable();
            $table->string('question_e', 100)->nullable();
            $table->string('question_f', 100)->nullable();
            $table->string('question_g', 100)->nullable();
            $table->string('question_h', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprehensions');
    }
};
