@include('layouts.welcome')
@extends('layouts.master')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="{{ asset('font/css/all.css') }}">

    <section class="content">
        <div class="container-fluid">
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
    <div class="custom-link-wrapper ">
        <a href="/pinjam/tampilan" class="btn btn-danger mx-1 px-26">Kembali</a>
    </div>
@endpush
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('Gagal'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('Gagal') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <div class="card-body">
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group mb-3">
                <label for="kategori" class="text-primary font-weight-bold">Kategori</label>
        <input type="text" name="Kategori" class="form-control" value="{{ $kategori->id }}" hidden>
        <input type="text" class="form-control" value="{{ $kategori->nama }}" readonly>
        </div> --}}
        <div class="form-group mb-3">
            <label for="kategori_id" class="text-primary font-weight-bold">Kategori</label>
    <input type="text" name="kategori_id" class="form-control" value="{{  $bukus->kategori->id }}" hidden>
    <input type="text" class="form-control" value="{{ $bukus->kategori->nama }}" readonly>
    </div>

        <div class="form-group mb-3">
            <label for="buku_id" class="text-primary font-weight-bold">Buku</label>
    <input type="text" name="buku_id" class="form-control" value="{{ $bukus->id }}" hidden>
    <input type="text" class="form-control" value="{{ $bukus->judul }}" readonly>
    </div>

            <div class="form-group mb-3">
                <label for="nama_peminjam" class="text-primary font-weight-bold"> Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" value="{{ old('nama_peminjam') }}">
                @error('nama_peminjam')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

         <div class="form-group mb-3">
                <label for="alamat" class="text-primary font-weight-bold"> Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="no_hp" class="text-primary font-weight-bold">No Hp</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                @error('no_hp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control">
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
        changePageTitle("Halaman Pinjam Buku");
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen input tanggal pinjam
        const tanggalPinjamInput = document.getElementById('tanggal_pinjam');
        // Ambil elemen input tanggal wajib kembali
        const tanggalWajibKembaliInput = document.getElementById('tanggal_wajib_kembali');

        // Tetapkan nilai default untuk tanggal pinjam sebagai tanggal hari ini
        const today = new Date();
        const year = today.getFullYear();
        let month = today.getMonth() + 1;
        let day = today.getDate();

        if (month < 10) {
            month = '0' + month;
        }

        if (day < 10) {
            day = '0' + day;
        }

        const formattedDate = year + '-' + month + '-' + day;
        tanggalPinjamInput.value = formattedDate;

        // Hitung tanggal wajib kembali (7 hari setelah tanggal pinjam)
        tanggalPinjamInput.addEventListener('change', function() {
            const tanggalPinjam = new Date(this.value);
            const tanggalWajibKembali = new Date(tanggalPinjam.getTime() + (7 * 24 * 60 * 60 * 1000));
            const wajibKembaliYear = tanggalWajibKembali.getFullYear();
            let wajibKembaliMonth = tanggalWajibKembali.getMonth() + 1;
            let wajibKembaliDay = tanggalWajibKembali.getDate();

            if (wajibKembaliMonth < 10) {
                wajibKembaliMonth = '0' + wajibKembaliMonth;
            }

            if (wajibKembaliDay < 10) {
                wajibKembaliDay = '0' + wajibKembaliDay;
            }

            const formattedWajibKembaliDate = wajibKembaliYear + '-' + wajibKembaliMonth + '-' + wajibKembaliDay;
            tanggalWajibKembaliInput.value = formattedWajibKembaliDate;
        });
    });
</script>

@endsection
