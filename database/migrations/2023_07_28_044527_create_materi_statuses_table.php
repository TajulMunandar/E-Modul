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
        Schema::create('materi_statuses', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->foreignId('userId')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('materiId')->constrained('materis')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_statuses');
    }
};
