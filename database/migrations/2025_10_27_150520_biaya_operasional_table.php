<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biaya_operasional', function (Blueprint $table) {
            $table->id();
            $table->date('bulan');
            $table->decimal('listrik', 10, 2);
            $table->decimal('air', 10, 2);
            $table->decimal('transportasi', 10, 2);
            $table->decimal('lainnya', 10, 2);
            $table->decimal('total_biaya', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biaya_operasional');
    }
};
