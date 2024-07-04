<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = "bukus";
    protected $primaryKey = "id";
    protected $fillable = [
        'judul',
        'kode_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'total_buku',
        'stok',
        'totalPembaca',
        'gambar'
    ];

    public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id',);
    }
    // public function baca()
    // {
    //     return $this->belongsTo(Baca::class,);
    // }
    public function baca()
    {
        return $this->hasMany(Baca::class);
    }
}
