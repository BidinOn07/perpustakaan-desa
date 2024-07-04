<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Baca;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
        $kategoris = Kategori::all();
        $baca = Baca::all();
        $bukus = Buku::query();

         // Inisialisasi query builder
         $query = Buku::latest();

         // Lakukan filter berdasarkan input pencarian jika ada
         if ($request->has('search')) {
             $searchTerm = $request->input('search');
             $query->where(function ($query) use ($searchTerm) {
                 $query->where('judul', 'like', '%' . $searchTerm . '%')
                     ->orWhere('stok', 'like', '%' . $searchTerm . '%');
             });
         }
         if ($request->filled('kategori')) {
            $kategoriId = $request->kategori;
            $query->whereHas('kategori', function ($query) use ($kategoriId) {
                $query->where('id', $kategoriId);
            });
        } else {
            // Jika tidak ada kategori yang dipilih, tidak perlu menerapkan filter
            // Jadi, tidak perlu menambahkan kondisi tambahan di sini
        }

        // Ambil data buku yang dipaginasi
        $bukus = $query->paginate(10);

         // Jika permintaan adalah AJAX, kembalikan data buku dalam format JSON
        //  if ($request->ajax()) {
        //      return response()->json($bukus);
        //  }

         // Kembalikan tampilan dengan data buku, kategori, dan hasil filter
         return view('buku.tampilan', compact('kategoris', 'bukus','baca'));
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bukus = Buku::all();
        $kategoris = Kategori::all();

        return view('buku.tambah', [
            'bukus' => $bukus,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'kode_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'deskripsi' => 'required',
            'total_buku' => 'required',
            'stok' => 'required',
            'gambar' => 'image|file', // Menggunakan aturan 'image' untuk memvalidasi gambar
            'kategori_id' => 'required' // Pastikan kategori dipilih
        ]);

        if ($request->hasFile('gambar')) {
            // Simpan gambar di direktori yang ditentukan dan dapatkan path-nya
            $gambarPath = $request->file('gambar')->store('public/images');
            $validatedData['gambar'] = $gambarPath;
        }

        $buku = new Buku($validatedData);
        $buku->kategori_id = $request->kategori_id;
        // Menambahkan kategori
        $buku->save();

        return redirect('/buku/tambah')->with('success', 'Buku berhasil ditambahkan!');
    }


public function edit(Buku $buku)
{
    $bukus = Buku::all();
    $kategoris = Kategori::all();
    return view('buku.edit', ['buku' => $buku,  'kategoris' => $kategoris], )
    ;
}
    /**
     * Display the specified resource.
     */
    public function show($buku)
    {
        $buku = Buku::with('kategori')->findOrFail($buku);
        return view('buku.detail', ['buku' => $buku]);
    }

    public function update(Request $request, Buku $buku)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            // Aturan validasi lainnya di sini
            'judul' => 'required',
            'kode_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'deskripsi' => 'required',
            'total_buku' => 'required',
            'stok' => 'required',
            'gambar' => 'image|file',
            // 'gambar' => 'nullable|file|image|', // Menggunakan aturan 'image' untuk memvalidasi gambar
            'kategori_id' => 'required',

        ]);


        if ($request->hasFile('gambar')) {
            // Simpan gambar di direktori yang ditentukan dan dapatkan path-nya
            $gambarPath = $request->file('gambar')->store('public/images');
            $validatedData['gambar'] = $gambarPath;
        }

        // Update data buku yang sudah ada dengan data yang divalidasi
        $buku->update($validatedData);

        // Perbarui kategori_id jika diubah
        if ($request->has('kategori_id')) {
            $buku->kategori_id = $request->kategori_id;
            $buku->save();
        }

        return redirect("/buku/edit/{$buku->id}/edit")->with('success', 'Data berhasil di edit');
    }
    // public function baca (Request $request)
    // {
    //     $buku = Buku::find($request->id);

    //     if ($buku) {
    //         // Jika data peminjaman ada, tingkatkan jumlah pembaca
    //         $buku->pembaca += 1;
    //         $buku->save();
    //     } else {
    //         // Jika data peminjaman tidak ada, buat entri baru dengan pembaca = 1
    //         // Hanya jika diperlukan, namun dalam kasus ini kita fokus pada kolom 'pembaca' saja
    //         return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
    //     }

    //     return redirect()->back()->with('success', 'Jumlah pembaca berhasil ditambahkan!');
    // }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        Buku::destroy($buku->id);
        return redirect('/buku/tampilan')->with('success', 'Buku berhasil dihapus');
    }
}
