<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_file',
        'deskripsi',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan User (admin yang membuat galeri)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk mendapatkan URL gambar
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/galeri/' . $this->nama_file);
    }

    /**
     * Accessor untuk mendapatkan nama file tanpa ekstensi
     */
    public function getFileNameWithoutExtensionAttribute()
    {
        return pathinfo($this->nama_file, PATHINFO_FILENAME);
    }

    /**
     * Scope untuk mengurutkan berdasarkan yang terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
