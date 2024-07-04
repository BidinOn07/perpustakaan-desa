<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use Illuminate\Support\Facades\TA;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
      TA::table('bukus')->insert([

        'judul' => 'jukk',
        'kode_buku'=>'abc',
        'pengarang'=>'ni',
        'penerbit' =>'jdieu',
        'tahun_terbit'=>'hsu',
        'deskripsi'=>'jcisko',
        'status' =>"ya",
        'dipinjam'=>'12',
        'dikembalikan'=>'67',

      ]);
    }
}
