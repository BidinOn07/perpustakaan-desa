@include('layouts.welcome')

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <section class="content">
        <div class="container-fluid">
            <style>
                /* CSS untuk mengatur sel tabel agar tidak ditampilkan dan teks digantikan dengan titik-titik */
                table {
                    table-layout: fixed;
                    width: 100%;
                    border-collapse: collapse;
                }

                td {
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                }
            </style>

            <style>
                body {
                    margin: 0;
                    padding: 0px;
                    font-family: sans-serif;
                }

                * {
                    box-sizing: border-box;
                }

                .table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .table td,
                .table th {
                    padding: 12px 15px;
                    border: 1px solid #ddd;
                    text-align: center;
                    font-size: 16px;
                }


                .table tbody tr:nth-child(even) {
                    background-color: #f5f5f5;
                }

                @media(max-width: 500px) {
                    .table thead {
                        display: none;
                    }

                    .table,
                    .table tbody,
                    .table tr,
                    .table td {
                        display: block;
                        width: 100%;
                    }

                    .table tr {
                        margin-bottom: 15px;
                    }

                    .table td {
                        text-align: left;
                        padding-left: 50%;
                        text-align: right;
                        position: relative;
                    }

                    .table td::before {
                        content: attr(data-label);
                        position: absolute;
                        left: 0;
                        width: 50%;
                        padding-left: 15px;
                        font-size: 15px;
                        font-weight: bold;
                        text-align: left;
                    }
                }

                .custom-link-wrapper {
        margin-bottom: 20px; /* Menambahkan jarak ke bawah */
        text-align: left; /* Mengatur posisi tombol ke kanan */
    }

    .custom-link-wrapper .btn {
        margin-top: 10px; /* Menambahkan jarak dari atas */
    }
</style>
<div class="custom-link-wrapper">
    <a href="/buku/tampilan" class="btn btn-danger">Kembali</a>
</div>


</head>
<body>
<table id="table" class="table table-bordered table-hover">
    <div class="table-responsive">
        <div class="mb-3">
            <input type="text" id="search" name="search" class="form-control" placeholder="Cari...">
        </div>
      <thead>
        <tr>
          <th style="width: 5%;">No</th>
          <th style="width: 20%;">Nama</th>
          <th style="width: 10%;">Alamat</th>
          <th style="width: 20%;">Tanggal</th>
          <th style="width: 15%;">Nama Buku</th>
        </tr>
      </thead>
<!-- Your JavaScript code -->
<script>
    // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
    changePageTitle("Halaman Detail");
    </script>


</body>
</html>
