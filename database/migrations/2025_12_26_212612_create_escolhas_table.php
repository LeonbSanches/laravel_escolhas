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
        Schema::create('escolhas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('militar_id')->constrained('militares')->onDelete('cascade');
            $table->foreignId('unidade_id')->constrained('unidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escolhas');
    }
};
