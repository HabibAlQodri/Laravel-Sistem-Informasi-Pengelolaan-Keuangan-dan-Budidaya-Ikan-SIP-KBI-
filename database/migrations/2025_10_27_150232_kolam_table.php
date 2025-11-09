<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kolam', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kolam');
            $table->string('lokasi');
            $table->decimal('luas_m2', 10, 2);
            $table->integer('kapasitas_ikan');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kolam');
    }
};
