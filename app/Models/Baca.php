<?php

namespace App\Models;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baca extends Model
{
    use HasFactory;
    protected $table = "baca";
    protected $primaryKey = "id";
    protected $fillable = [
        'pembaca',
        'tanggal_baca',
        'kategori_id',
        'buku_id',
      ];

        public function kategori()
        {
            return $this->belongsTo(Kategori::class);
        }

        public function buku()
        {
            return $this->belongsTo(Buku::class);
        }
    }
