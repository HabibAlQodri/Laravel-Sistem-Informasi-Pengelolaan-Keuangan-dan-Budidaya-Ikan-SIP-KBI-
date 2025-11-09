<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIkan extends Model
{
    use HasFactory;

    protected $table = 'jenis_ikan';
    protected $fillable = [
        'nama_ikan', 'berat', 'masa_panen_hari', 'harga_per_kg', 'keterangan'
    ];

    public function panen()
    {
        return $this->hasMany(Panen::class, 'jenis_id');
    }
}
