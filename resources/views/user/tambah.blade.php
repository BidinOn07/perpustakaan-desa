@include('layouts.welcome')
@extends('layouts.master')
@section('title', 'Tambah Bukuu')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px; /* Sesuaikan dengan kebutuhan Anda */
    }

    .form-group label {
        width: 150px; /* Sesuaikan dengan lebar label Anda */
        margin-right: 20px; /* Sesuaikan dengan jarak antara label dan input */
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        flex: 1;
    }
    .custom-link-wrapper {
        margin-bottom: 20px; /* Menambahkan jarak ke bawah */
        text-align: left; /* Mengatur posisi tombol ke kanan */
    }

    .custom-link-wrapper .btn {
        margin-top: 10px; /* Menambahkan jarak dari atas */

    }
</style>
<div class="custom-link-wrapper ";>
    <a href="/buku/tampilan" class="btn btn-danger mx-1 px-26">Kembali</a>
</div>
@endpush
@section('content')
<div class="card-body">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('loginEror'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginEror') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <form action="/user/tambah" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="nama" class="text-primary font-weight-bold">Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" required value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email" class="text-primary font-weight-bold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password" class="text-primary font-weight-bold">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
            </div>
        </form>

<script>
    // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
    changePageTitle("Halaman Tambah User");
</script>
@endsection
