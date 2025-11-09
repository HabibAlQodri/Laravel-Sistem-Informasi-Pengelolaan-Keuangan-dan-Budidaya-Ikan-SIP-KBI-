<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panen_id')->constrained('panen')->onDelete('cascade');
            $table->date('tanggal_jual');
            $table->string('pembeli');
            $table->decimal('jumlah_kg', 10, 2);
            $table->decimal('harga_per_kg', 10, 2);
            $table->decimal('total_jual', 15, 2);
            $table->string('metode_bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
