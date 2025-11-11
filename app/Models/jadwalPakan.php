<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPakan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pakan';
    protected $fillable = [
        'kolam_id', 'nama_kolam', 'pakan_id', 'tanggal', 'jumlah_kg', 'catatan'
    ];

    public function kolam()
    {
        return $this->belongsTo(Kolam::class, 'kolam_id');
    }

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'pakan_id');
    }
}
