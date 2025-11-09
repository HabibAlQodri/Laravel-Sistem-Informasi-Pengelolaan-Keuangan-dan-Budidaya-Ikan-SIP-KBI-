<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gaji_karyawan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->date('bulan');
            $table->decimal('jumlah_gaji', 10, 2);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('potongan', 10, 2)->default(0);
            $table->decimal('total_diterima', 10, 2);
            $table->string('status_bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gaji_karyawan');
    }
};
