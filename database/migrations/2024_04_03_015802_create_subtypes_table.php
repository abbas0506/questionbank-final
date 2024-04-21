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
        Schema::create('subtypes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->string('name', 50);
            $table->string('language', 2)->nullable();
            $table->string('questionable_type', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtypes');
    }
};
