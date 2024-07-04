<?php

namespace App\Http\Controllers;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Inisialisasi query builder
        $query = Pengunjung::latest();

        // Lakukan filter berdasarkan input pencarian jika ada
        if ($request->input('search')) {
            $searchTerm = $request->input('search');
            $query->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTerm . '%');
        }

        // Lakukan pagination
        $pengunjungs = $query->paginate(10);

        // Kembalikan tampilan dengan data pengunjung yang dipaginasi
        return view('pengunjung.tampilan', ['pengunjungs' => $pengunjungs]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $pengunjungs = Pengunjung::all();
        return view('pengunjung.tambah', ['pengunjung' => $pengunjungs,]);
        Pengunjung::create($validateData);
        return redirect('/pengunjung/tambah');

    }

    /**
     * Store a newly created resource in storage.
     */

     public function cetak()
     {

         $pengunjungcetak = Pengunjung::all();
         return view('pengunjung.cetakk',compact('pengunjungcetak'));

     }

    public function store(Request $request)
    {
        {
            $validateData = $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
            ]);
            Pengunjung::create($validateData);
            return redirect('/pengunjung/tambah')->with('success', 'Data pengunjung berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Cari data pengunjung berdasarkan ID
    $pengunjung = Pengunjung::findOrFail($id);

    // Hapus data pengunjung dari database
    $pengunjung->delete();

    // Redirect ke halaman yang sesuai dengan pesan sukses
    return redirect()->back()->with('success', 'Data pengunjung berhasil dihapus.');
}
}
