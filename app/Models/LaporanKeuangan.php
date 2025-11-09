<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan';
    protected $fillable = [
        'bulan', 'total_pendapatan', 'total_pengeluaran', 'laba_bersih', 'catatan'
    ];
}
