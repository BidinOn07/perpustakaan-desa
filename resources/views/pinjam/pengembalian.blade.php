@include('layouts.welcome')
@extends('layouts.master')
@section('title', 'Tambah Bukuu')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            /* Sesuaikan dengan kebutuhan Anda */
        }

        .form-group label {
            width: 150px;
            /* Sesuaikan dengan lebar label Anda */
            margin-right: 20px;
            /* Sesuaikan dengan jarak antara label dan input */
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            flex: 1;
        }

        .custom-link-wrapper {
            margin-bottom: 20px;
            /* Menambahkan jarak ke bawah */
            text-align: left;
            /* Mengatur posisi tombol ke kanan */
        }

        .custom-link-wrapper .btn {
            margin-top: 10px;
            /* Menambahkan jarak dari atas */

        }
    </style>
    <div class="custom-link-wrapper ";>
        <a href="/pinjam/tampilan" class="btn btn-danger mx-1 px-26">Kembali</a>
    </div>
@endpush
@section('content')
    <div class="card-body">
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form-group mb-3">
            <label for="buku_id" class="text-primary font-weight-bold">Buku</label>
    <input type="text" name="buku_id" class="form-control" value="{{ $bukus->id }}" hidden>
    <input type="text" class="form-control" value="{{ $bukus->judul }}" readonly>
    </div>

            <div class="form-group mb-3">
                <label for="nama_peminjam" class="text-primary font-weight-bold"> Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" value="{{ $pinjam->nama_peminjam }}">
                @error('nama_peminjam')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

         <div class="form-group mb-3">
                <label for="alamat" class="text-primary font-weight-bold"> Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $pinjam->alamat }}">
                @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="no_hp" class="text-primary font-weight-bold">No Hp</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $pinjam->no_hp}}">
                @error('no_hp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="no_hp" class="text-primary font-weight-bold">Tanggal pinjam</label>
                <input type="text" name="tanggal pinjam" class="form-control" value="{{ $pinjam->tanggal_pinjam}}">
                @error('tanggal pinjam')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="no_hp" class="text-primary font-weight-bold">Tanggal Wajib kembali</label>
            <input type="text" name="tanggal wajib kembali" class="form-control" value="{{ $pinjam->tanggal_wajib_kembali}}">
            @error('tanggal pinjam')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

            <div class="form-group">
                <input type="date" id="tanggal_wajib_kembali" name="tanggal_wajib_kembali" class="form-control" >
            </div>

            {{-- <div class="form-group">
                <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control">
            </div> --}}

            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
            </div>
        </form>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    </div>
    </div>

    <script>
        $('#multiselect').select2({
            allowClear: true
        });
    </script>

    <script>
        // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
        changePageTitle("Halaman Tambah Peminjaman");
    </script>
    {{-- <script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            // Menghentikan pengiriman formulir secara langsung
            event.preventDefault();

            // Mendapatkan nilai input atau melakukan validasi lain jika diperlukan
            // Contoh: var inputValue = document.getElementById("inputId").value;

            // Menetapkan nilai action ke rute yang diinginkan
            this.action = "/pinjam/pinjams";

            // Mengirimkan formulir setelah nilai action diperbarui
            this.submit();
        });
    </script> --}}
@endsection
