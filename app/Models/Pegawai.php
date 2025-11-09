<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $fillable = [
        'nama', 'jabatan', 'tanggal_masuk', 'gaji_pokok'
    ];

    public function gajiKaryawan()
    {
        return $this->hasMany(GajiKaryawan::class, 'pegawai_id');
    }
}
