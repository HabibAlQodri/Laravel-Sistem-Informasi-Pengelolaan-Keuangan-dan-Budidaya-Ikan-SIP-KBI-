<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    protected $table = 'pakan';
    protected $primaryKey = 'id';

    protected $fillable = ['nama_pakan', 'jenis_pakan', 'harga_per_kg', 'stok_kg', 'supplier'];

    public function jadwalPakan()
    {
        return $this->hasMany(JadwalPakan::class, 'pakan_id');
    }
}
