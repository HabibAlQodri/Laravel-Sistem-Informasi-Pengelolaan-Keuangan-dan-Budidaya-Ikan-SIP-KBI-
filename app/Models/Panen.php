<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $table = 'panen';
    protected $fillable = [
        'kolam_id', 'jenis_id', 'tanggal_panen', 'berat_total_kg',
        'jumlah_ikan', 'harga_per_kg', 'total_pendapatan', 'catatan'
    ];

    public function kolam()
    {
        return $this->belongsTo(Kolam::class, 'kolam_id');
    }

    public function jenisIkan()
    {
        return $this->belongsTo(JenisIkan::class, 'jenis_id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'panen_id');
    }
}
