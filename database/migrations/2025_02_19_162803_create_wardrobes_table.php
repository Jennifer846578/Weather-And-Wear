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
        Schema::create('wardrobes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userid');
            $table->string('imagePath')->nullable();
            $table->string('color')->nullable();
            $table->string('category')->nullable();
            $table->string('style')->nullable();
            $table->string('favourite')->default('no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wardrobes');
    }
};
