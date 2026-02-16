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
        Schema::create('event_user', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel 'user' (singular)
            $table->foreignId('user_id')
                  ->constrained('user') // Wajib sebutkan nama tabelnya di sini
                  ->onDelete('cascade');

            // Relasi ke tabel 'event' (singular)
            $table->foreignId('event_id')
                  ->constrained('event') // Wajib sebutkan nama tabelnya di sini
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_user');
    }
};