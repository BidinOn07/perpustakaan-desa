@include('layouts.welcome')
@section('title', 'Tambah Buku')
@include('part.navbar')

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .btn-add:hover {
            background: linear-gradient(to right, #ffd194, #70e1f5); /* Gradient kuning hijau saat hover */
        }
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #f8f9fa; /* Warna latar belakang abu-abu muda */
        }
        .container-fluid {
            padding: 37px;
            background-color: #ffffff; /* Warna latar belakang putih */
           /* Tambahkan radius pada container */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Tambahkan bayangan untuk efek visual */
            margin-bottom: 20px; /* Tambahkan margin bawah untuk spasi */
        }
        .input-group {
            display: flex;
            align-items: center;
        }
        .form-select, .btn-primary {
            border-radius: 25px;
            padding: 8px 20px;
            margin: 5px;
        }
        .form-select {
            flex: 1;
        }
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
            border-radius: 15px;
            padding: 10px;
            background-color: #ffffff; /* Warna latar belakang putih */

            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Tambahkan bayangan untuk efek visual */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 25px; /* Tambahkan radius pada tabel */
            overflow: hidden; /* Hindari overflow dari sudut yang diberikan radius */
            border: transparent; /* Border untuk seluruh tabel */
        }
        .table th, .table td {
            padding: 12px 15px;
            border: none; /* Hapus border individual */
            text-align: center;
            font-size: 16px;
        }
        .table th {
            background-color: #364455; /* Warna latar belakang hijau */
            color: white; /* Warna teks putih */
        }
        .table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .btn {
            border-radius: 25px;
        }
        .btn-add {
            background: linear-gradient(to right,  #5b9546;, #ffd194);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-add:hover {
            background: linear-gradient(to right, #ffd194, #70e1f5);
        }
        @media(max-width: 500px) {
            .table thead {
                display: none;
            }
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }
            .table tr {
                margin-bottom: 15px;
            }
            .table td {
                text-align: right;
                position: relative;
                padding-left: 50%;
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
    </style>

</head>
<body>
    <header style="padding-top: 1px;">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-3">
                    <form action="/buku/tampilan" method="GET">
                        <div class="input-group mb-6">
                            <select name="kategori" class="form-select wx50">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-3">
                    <div class="input-group mb-3">
                        <a href="/buku/tambah" class="btn btn-add form-select">Tambah Buku</a> <!-- Ganti kelas btn-primary menjadi btn-add -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/buku/tampilan" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control form-control-rounded" placeholder="Cari..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <table id="table" class="table table-bordered table-hover">
            {{-- <div class="overflow-hidden position-relative border-radius-xl"> --}}
            {{-- <table id="table" class="table table-bordered  table-hover position-relative border-radius-xl "> --}}
                <thead>
                    <tr>
                        <th style="width: 5%;" onclick="sortTable(0)">No</th>
                        <th style="width: 10%;">Judul Buku<i class="fas fa-sort sortable-icon" onclick="sortTable(1)"></i></th>
                        <th style="width: 10%;">Kategori<i class="fas fa-sort sortable-icon" onclick="sortTable(2)"></i></th>
                        <th style="width: 10%;">Sampul</th>
                        <th style="width: 10%;">Total Buku<i class="fas fa-sort sortable-icon" onclick="sortTable(3)"></i></th>
                        <th style="width: 10%;">Stok<i class="fas fa-sort sortable-icon" onclick="sortTable(4)"></i></th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bukus as $buku)
                    <tr>
                        <td data-label="No">{{ ($bukus->currentPage() - 1) * $bukus->perPage() + $loop->iteration }}</td>
                        <td data-label="Judul Buku">{{ $buku->judul }}</td>
                        <td data-label="Kategori">{{ $buku->kategori->nama }}</td>
                        <td data-label="Sampul">
                            <img src="{{ url(Storage::url($buku->gambar)) }}" alt="Image Preview" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td data-label="Total Buku">{{ $buku->total_buku }}</td>
                        <td data-label="Stok">{{ $buku->stok }}</td>
                        <td data-label="Action">
                            <a href="/buku/edit/{{ $buku->id }}/edit" class="btn btn-light"> <i class="fas fa-pen"></i> Edit</a>
                            <a href="/buku/detail/{{ $buku->id }}/show" class="btn btn-dark"> <i class="fas fa-newspaper"></i> Detail</a>
                            <form action="/buku/tampilan/{{ $buku->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $bukus->links() }}
        </div>
    </div>

    <script>
        var ascending = true;
        function sortTable(col) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("table");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[col];
                    y = rows[i + 1].getElementsByTagName("td")[col];
                    if (ascending) {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
            ascending = !ascending;
        }
    </script>
</body>
</html>
