<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    use HasFactory;

    protected $table = 'kolam';
    protected $fillable = [
        'nama_kolam', 'lokasi', 'luas_m2', 'kapasitas_ikan', 'status'
    ];

    public function jadwalPakan()
    {
        return $this->hasMany(JadwalPakan::class, 'kolam_id');
    }

    public function panen()
    {
        return $this->hasMany(Panen::class, 'kolam_id');
    }
}
