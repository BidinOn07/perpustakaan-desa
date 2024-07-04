@include('layouts.welcome')

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="pagestyle" href="{{ asset('css/material-kit.css?v=3.0.4') }}" rel="stylesheet" />
    <style>
        /* CSS for table and content styling */
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

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
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
            }
        }

        .container-fluids {
            padding-top: 15px;
            padding-right: 15px;
        }

        .content {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <header class="container-fluids">
        <div class="row justify-content-between">
            <div class="col-4">
                <div class="float-start mb-2">
                    <a href="/buku/tampilan" class="btn btn-danger mx-1 px-26">Kembali</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <div class="row justify-content-center">
                
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ url(Storage::url($buku->gambar)) }}" alt="Image Preview" style="height: 200px; width: 200px;" class="img-fluid border-radius-lg">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="font-weight-normal">
                                <h2>" {{ $buku->judul }} "</h2>
                            </h5>
                            <p class="mb-0">Kategori: {{ $buku->kategori->nama }}</p>
                            <p class="mb-0">Deskripsi: {{ $buku->deskripsi }}</p>
                            <p class="mb-0">Kode Buku: {{ $buku->kode_buku }}</p>
                            <p class="mb-0">Penulis: {{ $buku->penulis }}</p>
                            <p class="mb-0">Penerbit: {{ $buku->penerbit }}</p>
                            <p class="mb-0">Tahun Terbit: {{ $buku->tahun_terbit }}</p>
                            <p class="mb-0">Total Buku: {{ $buku->total_buku }}</p>
                            <p class="mb-0">Stok: {{ $buku->stok }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
        changePageTitle("Halaman Detail Buku");
    </script>

</body>

</html>
