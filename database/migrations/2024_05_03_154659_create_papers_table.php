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
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('title', 300)->nullable();
            $table->string('institution', 300)->nullable();
            $table->date('paper_date');
            $table->unsignedTinyInteger('duration')->default(0); //in munites

            $table->unsignedTinyInteger('font_size')->default(12);
            $table->string('page_size', 10)->default('a4');
            $table->string('page_layout', 10)->default('portrait');
            $table->unsignedTinyInteger('page_rows')->default(1);
            $table->unsignedTinyInteger('page_cols')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papers');
    }
};
