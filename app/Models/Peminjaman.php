<?php

namespace App\Models;
use App\Models\Buku;
use App\Models\Baca;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjamen";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_peminjam',
        'alamat',
        'no_hp',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_wajib_kembali',
        'tanggal_pengembalian',
        'kategori_id',
        'baca_id',
      ];

      public function bukus()
      {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
      }
      public function kategori()
      {
          return $this->belongsTo(Kategori::class, 'kategori_id',);
      }
      public function baca()
      {
          return $this->belongsTo(Baca::class, 'baca_id',);
      }

}

