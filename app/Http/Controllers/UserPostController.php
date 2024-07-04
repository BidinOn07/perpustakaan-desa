<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\DataChart;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Inisialisasi query builder
        $query = User::latest();
        // $users = User::all();

        // Lakukan filter berdasarkan input pencarian jika ada
        if ($request->input('search')) {
            $searchTerm = $request->input('search');
            $query->where('nama', 'like', '%' . $searchTerm . '%');
                //   ->orWhere('stok', 'like', '%' . $searchTerm . '%');
        }

        // Lakukan pagination
        $users = $query->paginate(4);

        // Kembalikan tampilan dengan data pengunjung yang dipaginasi
        return view('user.tampilan', ['users' => $users]);
    }
    /**

     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User ::all();

        return view('user.tambah', [
            // 'bukus' => $bukus,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:3', // Perbaikan penulisan
            'email' => 'required|email:dns', // Perbaikan sintaks dan penghapusan :dns
            'password' => 'required|min:5' // Perbaikan penulisan dan penambahan nilai minimum
        ]);

        $validateData['password'] = bcrypt($validateData['password']); //
       User::create($validateData);

       $request->session()->flash('success','User Berhasil Ditambah');

       return redirect('/user/tambah');
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
        $data =User::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect('/user/tampilan')->with('success', 'User berhasil dihapus');
    }

    public function coba(DataChart $chart)
    {
       return view('home', ['chart' => $chart->build()]);
    }
}
