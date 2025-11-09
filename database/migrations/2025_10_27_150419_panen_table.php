<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolam')->onDelete('cascade');
            $table->foreignId('jenis_id')->constrained('jenis_ikan')->onDelete('cascade');
            $table->date('tanggal_panen');
            $table->decimal('berat_total_kg', 10, 2);
            $table->integer('jumlah_ikan');
            $table->decimal('harga_per_kg', 10, 2);
            $table->decimal('total_pendapatan', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panen');
    }
};
