<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

    protected $table = 'gaji_karyawan';
    protected $fillable = [
        'pegawai_id', 'bulan', 'jumlah_gaji', 'bonus', 'potongan',
        'total_diterima', 'status_bayar'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
