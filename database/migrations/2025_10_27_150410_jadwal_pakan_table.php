<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolam')->onDelete('cascade');
            $table->foreignId('pakan_id')->constrained('pakan')->onDelete('cascade');
            $table->date('tanggal');
            $table->decimal('jumlah_kg', 10, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pakan');
    }
};
