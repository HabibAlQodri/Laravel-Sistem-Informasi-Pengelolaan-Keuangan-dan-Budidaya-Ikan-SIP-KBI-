<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = [
        'panen_id', 'tanggal_jual', 'pembeli', 'jumlah_kg',
        'harga_per_kg', 'total_jual', 'metode_bayar'
    ];

    public function panen()
    {
        return $this->belongsTo(Panen::class, 'panen_id');
    }
}
