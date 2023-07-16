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
        Schema::create('choice_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('nilai');
            $table->foreignId('jawabanId')->constrained('jawabans')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choice_users');
    }
};
