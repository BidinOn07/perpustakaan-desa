<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        $query = Kategori ::oldest();
        // $users = User::all();

        // Lakukan filter berdasarkan input pencarian jika ada
        if ($request->input('search')) {
            $searchTerm = $request->input('search');
            $query->where('nama', 'like', '%' . $searchTerm . '%');
                //   ->orWhere('stok', 'like', '%' . $searchTerm . '%');
        }

        // Lakukan pagination
        $kategoris = $query->paginate(10);

        return view('kategori', ['kategoris' => $kategoris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $bukus = Buku::all();
        $kategoris = Kategori::all();

        return view('kategori.tambah', [
            // 'bukus' => $bukus,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $validateData = $request->validate([
                'nama' => 'required',
                'deskripsi' => 'required',
            ]);
            Kategori::create($validateData);
            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
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
    public function destroy(Request $request, $id)
    {
        $data = Kategori::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}

