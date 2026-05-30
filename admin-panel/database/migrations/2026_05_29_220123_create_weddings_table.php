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
        Schema::create('weddings', function (Blueprint $table) {
        $table->id();
        $table->string('slug')->unique(); // Contoh: budi-leni (untuk URL)
        $table->string('nama_pria');
        $table->string('nama_wanita');
        $table->date('tanggal_acara');
        $table->text('lokasi_acara');
        $table->string('tema'); // rustic, modern, sage, dll
        $table->enum('paket', ['basic', 'premium'])->default('basic');
        $table->string('musik_url')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
