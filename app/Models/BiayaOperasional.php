<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaOperasional extends Model
{
    use HasFactory;

    protected $table = 'biaya_operasional';
    protected $fillable = [
        'bulan', 'listrik', 'air', 'transportasi', 'lainnya', 'total_biaya'
    ];
}
