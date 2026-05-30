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
        Schema::create('rsvps', function (Blueprint $table) {
        $table->id();
        // Menghubungkan RSVP dengan data pernikahan tertentu
        $table->foreignId('wedding_id')->constrained('weddings')->onDelete('cascade');
        $table->string('nama_tamu');
        $table->integer('jumlah_hadir')->default(1);
        $table->enum('status', ['hadir', 'tidak_hadir']);
        $table->text('ucapan')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};
