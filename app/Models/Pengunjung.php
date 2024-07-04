<?php

namespace App\Models;

use App\Models\Pengunjung;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengunjung extends Model
{

    protected $fillable = [
        'nama',
        'alamat'
    ];
    
}
