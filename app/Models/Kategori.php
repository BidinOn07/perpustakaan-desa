<?php

namespace App\Models;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class);
    }

}





