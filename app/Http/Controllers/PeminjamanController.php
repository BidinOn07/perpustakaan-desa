<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Baca;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // Mulai dengan query untuk model Buku
        $query = Buku::latest();

        // Jika ada permintaan pencarian, tambahkan filter pencarian
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('judul', 'like', '%' . $searchTerm . '%')
                    ->orWhere('stok', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil semua buku untuk keperluan tampilan di antarmuka
        $bukus = $query->get();

        // Lakukan paginasi pada hasil query untuk tampilan daftar peminjaman
        $peminjamen = $query->paginate(10);

        // Query untuk mengambil data dari tabel Baca
        $baca = Baca::all(); // Atau sesuaikan query jika perlu filter atau kondisi

        // $totalPembaca = Buku::withCount('bacas')->sum('bacas_count');

        // Kemudian, kembalikan data ke view
        return view('pinjam.tampilan', [
            'peminjamen' => $peminjamen,
            'bukus' => $bukus,
            'baca' => $baca, // Sertakan data bacaan
            // 'totalPembaca' => $totalPembaca
        ]);
    }


    public function create(Request $request)
    {
        $judul = $request->judul;
        $buku = Buku::where('judul', $judul)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        return view('pinjam.pinjams', ['bukus' => $buku]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'nama_peminjam' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            // 'tanggal_pinjam' => 'required|date',
            // 'tanggal_wajib_kembali' => 'required|date',
        ]);

        $buku = Buku::where('judul', $request->judul)->first();

        if ($buku) {
            if ($buku->stok > 0) {
                // Stok buku tersedia, lakukan peminjaman
                $buku->stok--;
                $buku->save();

                $tanggal_pinjam = now();
                $tanggal_wajib_kembali = now()->addDays(7);

                // Assuming kategori_id is part of the request or you need to fetch it from somewhere else
                $kategori_id = $request->kategori_id; // You need to define kategori_id here

                Peminjaman::create([
                    'kategori_id' => $kategori_id,
                    'buku_id' => $buku->id,
                    'nama_peminjam' => $request->nama_peminjam,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                    'tanggal_pinjam' => $tanggal_pinjam,
                    'tanggal_wajib_kembali' => $tanggal_wajib_kembali,
                ]);
                session()->flash('success', 'Buku berhasil dipinjam!');
            } else {
                // Stok buku tidak tersedia
                session()->flash('error', 'Maaf, stok buku telah habis.');
            }
        } else {
            session()->flash('error', 'Buku tidak ditemukan.');
        }

        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');;
    }

public function info (Request $request)
{
    $searchQuery = $request->input('search');
    $query = Buku::latest()->join('peminjamen', 'bukus.id', '=', 'peminjamen.buku_id');

    // Menggunakan "with" untuk eager loading relasi Buku
    $peminjamen = Peminjaman::join('bukus', 'peminjamen.buku_id', '=', 'bukus.id')
    ->where('bukus.judul', 'LIKE', "%$searchQuery%")
    ->orWhere('peminjamen.nama_peminjam', 'like',"%$searchQuery%")
    ->select('peminjamen.*')
    ->paginate(10);
    // $peminjamen = Peminjaman::latest()->with('bukus')->paginate(10);
    // Mengembalikan data ke view
    return view('datapinjam', compact('peminjamen'));
}


    public function cetak()
    {

        $peminjam = Peminjaman ::all();
        return view('pinjam.cetak',compact('peminjam'));

    }

    // Other methods can be added as per requirements
    public function approve(Request $request)
    {
        $tanggal_pengembalian = now(); // Mengambil tanggal dan waktu saat ini
        $peminjaman = Peminjaman::find($request->id);

        if ($peminjaman) {
            // Menyimpan tanggal pengembalian
            $peminjaman->tanggal_pengembalian = $tanggal_pengembalian;
            $peminjaman->save();

            // Temukan buku yang sesuai dan tambahkan stoknya
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->stok += 1; // Menambah stok buku
                $buku->save();
            } else {
                // Jika buku tidak ditemukan, tampilkan pesan error
                session()->flash('error', 'Buku tidak ditemukan.');
                return redirect()->back();
            }

            // Setelah menambah stok, tampilkan pesan sukses
            session()->flash('success', 'Pengembalian buku berhasil disetujui.');
            return redirect()->back();
        } else {
            // Jika peminjaman tidak ditemukan, tampilkan pesan error
            session()->flash('error', 'Peminjaman tidak ditemukan.');
            return redirect()->back();
        }

    }
    // public function baca (Request $request)
    // {
    //     $peminjaman = Peminjaman::find($request->buku_id);

    //     if ($peminjaman) {
    //         // Jika data peminjaman ada, tingkatkan jumlah pembaca
    //         $peminjaman->pembaca += 1;
    //         $peminjaman->save();
    //     } else {
    //         // Jika data peminjaman tidak ada, buat entri baru dengan pembaca = 1
    //         // Hanya jika diperlukan, namun dalam kasus ini kita fokus pada kolom 'pembaca' saja
    //         return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
    //     }

    //     return redirect()->back()->with('success', 'Jumlah pembaca berhasil ditambahkan!');
    // }
}
