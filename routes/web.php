 <?php
use Illuminate\Support\Facades\Route;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjamen;
use App\Models\Pengunjung;
use App\Models\Home;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\WellcomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanChart;
use App\Http\Controllers\PembacaController;





Route::post('/tambah', [WellcomeController::class, 'store']);
Route::get('/', [WellcomeController::class, 'index']);
Route::get('/auten/register', [RegisterController::class, 'index'])->name('auten.register');
Route::post('/auten/register', [RegisterController::class, 'store']);
Route::get('/auten/login', [LoginController::class, 'index'])->name('auten.login');
Route::post('/auten/login', [LoginController::class, 'authenticate']);
// Route::post('/', [LoginController::class, 'logout']);

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index']);
    // Route::get('/home', [PeminjamanChart::class, 'build']);

Route::post('/', [LoginController::class, 'logout']);
Route::get('/buku/tampilan', [BukuController::class, 'index']);
Route::post('/buku/tambah', [BukuController::class, 'store']);
Route::get('/buku/tambah', [BukuController::class, 'create']);
Route::get('/buku/detail/{buku}/show', [BukuController::class, 'show']);
Route::put('/buku/edit/{buku}/update', [BukuController::class, 'update']);
Route::get('/buku/edit/{buku}/edit', [BukuController::class, 'edit']);
Route::delete('/buku/tampilan/{buku}', [BukuController::class, 'destroy']);
// Route::get('/pinjam/tampilan/{id}', [BukuController::class, 'baca'])->name('buku.baca');

Route::get('/pengunjung/tampilan', [PengunjungController::class, 'index']);
Route::get('/pengunjung/tambah', [PengunjungController::class, 'create']);
Route::post('/pengunjung/tambah', [PengunjungController::class, 'store']);
Route::delete('/pengunjung/tampilan/{pengunjung}', [PengunjungController::class, 'destroy']);
Route::get('/pengunjung/cetakk', [PengunjungController::class, 'cetak']);
Route::get('home', [HomeController::class, 'index']);
// Route::get('/pengunjung/cetakp', 'PengunjungController@cetak')->name('pengunjung.cetakp');

// Route::get('/report', [HomeController::class, 'rpt']);

Route::get('/user/tampilan', [UserPostController::class, 'index']);
Route::get('/user/tambah', [UserPostController::class, 'create']);
Route::post('/user/tambah', [UserPostController::class, 'store']);
Route::delete('/user/tampilan/{id}', [UserPostController::class, 'destroy'])->name('user.delete');

// Route::get('/pinjam/tampilan/{id}', [PembacaController::class, 'baca'])->name('buku.baca');
Route::post('pinjam/tampilan/{kategori_id}/{buku_id}', [PembacaController::class, 'baca'])->name('pembaca.baca');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/tambah', [KategoriController::class, 'create']);
Route::post('/kategori/tambah', [KategoriController::class, 'store']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
// Route::get('/hiu', [HomeController::class, 'index']);
// Route::get('/pinjam/tampilan/{id}', [PeminjamanController::class, 'baca'])->name('pinjam.baca');
Route::get('/pinjam/tampilan', [PeminjamanController::class, 'index']);
Route::get('/pinjam/pinjams/', [PeminjamanController::class, 'create'])->name('pinjam.pinjams');
Route::post('/pinjam/pinjams', [PeminjamanController::class, 'store']);
Route::get('/datapinjam', [PeminjamanController::class, 'info']);
Route::get('/pinjam/cetak', [PeminjamanController::class, 'cetak']);
Route::post('/datapinjam/{id}/', [PeminjamanController::class, 'approve'])->name('datapinjam');

Route::get('dashboard', function () {
    return view('dashboard');
});
Route::get('/Kategori/tampil', function () {
    return view('kategori.tampil');
});
Route::get('/layouts/welcome', function () {
    return view('layouts.welcome');

});

//
// Route::get('/pengunjung/cetakp', function () {
//     return view('pengunjung.cetakp');
// });
//

// Route::get('home', function () {
//     return view('home');
// });

Route::get('jjj', function () {
    return view('jjj');
});


Route::get('/bi', function () {
    return view('bi');
});


// Route::get('kategori', function () {
//     return view('kategori');
// });



});
