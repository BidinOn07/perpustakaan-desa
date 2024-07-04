<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use Illuminate\Support\Facades\TA;

class BukusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
        {
            Bukus::create([
                'judul' => 'jukk',
                'kode_buku' => 'abc',
                'pengarang' => 'ni',
                'penerbit' => 'jdieu',
                'tahun_terbit' => 'hsu',
                'deskripsi' => 'jcisko',
                'status' => 'ya',
                'dipinjam' => 12,
                'dikembalikan' => 67,

          ]);
        }
    }

