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
        Schema::create('essay_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('questionId')->constrained('questions')->onUpdate('cascade')->onDelete('restrict');
            $table->text('jawaban');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('essay_users');
    }
};
