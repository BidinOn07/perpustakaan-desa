<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Baca;
use App\Http\Requests\StorePembacaRequest;
use App\Http\Requests\UpdatePembacaRequest;

class PembacaController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function baca(Request $request, $kategori_id, $buku_id)
    {
        // Buat data pembaca baru
        $tanggal_baca= now(); // Mengambil tanggal dan waktu saat ini
        $baca = Baca::create([
            'kategori_id' => $kategori_id,
            'buku_id' => $buku_id,
            'tanggal_baca' => $tanggal_baca,
            'pembaca'=> 1
        ]);
        $bukus = Buku::with('baca')->get();
        return view('pinjam.tampilan', compact('bukus'));
        return redirect()->back()->with('success', 'Peminjaman buku berhasil.');
    }



    /**
     * Menampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan sumber daya yang baru dibuat.
     */
    public function store(StorePembacaRequest $request)
    {
        //
    }

    /**
     * Menampilkan sumber daya yang ditentukan.
     */
    public function show(Pembaca $pembaca)
    {
        //
    }

    /**
     * Menampilkan formulir untuk mengedit sumber daya yang ditentukan.
     */
    public function edit(Pembaca $pembaca)
    {
        //
    }

    /**
     * Memperbarui sumber daya yang ditentukan di penyimpanan.
     */
    public function update(UpdatePembacaRequest $request, Pembaca $pembaca)
    {
        //
    }

    /**
     * Menghapus sumber daya yang ditentukan dari penyimpanan.
     */
    public function destroy(Pembaca $pembaca)
    {
        //
    }
}
