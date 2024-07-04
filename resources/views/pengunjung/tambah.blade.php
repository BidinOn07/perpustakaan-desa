@include('layouts.welcome')
@extends('layouts.master')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <section class="content">
        <div class="container-fluid">
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
<div class="custom-link-wrapper ">
    <a href="/pengunjung/tampilan" class="btn btn-danger mx-1 px-26">Kembali</a>
</div>
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

<div class="card-body">
    <form action="/pengunjung/tambah" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama" class="text-primary font-weight-bold">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama pengunjung">
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat" class="text-primary font-weight-bold">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Masukkan alamat pengunjung"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-1 px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>

<script>
    $('#multiselect').select2({
        allowClear: true
    });
</script>

<script>
    // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
    changePageTitle("Halaman Tambah Pengunjung");
</script>
@endsection
