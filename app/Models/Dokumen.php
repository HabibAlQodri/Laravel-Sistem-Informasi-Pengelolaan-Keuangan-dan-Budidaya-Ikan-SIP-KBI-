<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';
    protected $fillable = [
        'user_id', 'title', 'filename', 'file_path', 'file_type',
        'file_size', 'category', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
