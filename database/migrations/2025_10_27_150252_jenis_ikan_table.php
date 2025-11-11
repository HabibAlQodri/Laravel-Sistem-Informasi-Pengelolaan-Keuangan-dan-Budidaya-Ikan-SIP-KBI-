<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_ikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ikan');
            $table->decimal('berat', total: 10, places: 2);
            $table->integer('masa_panen_hari');
            $table->float('harga_per_kg');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_ikan');
    }
};
