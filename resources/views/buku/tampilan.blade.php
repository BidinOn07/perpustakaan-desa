@include('layouts.welcome')
@section('title', 'Tambah Buku')
@include('part.navbar')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
       Data Buku
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
          h1 {
            color: white; /* Tulisan h1 menjadi putih */
        }
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #f8f9fa; /* Light grey background color */
        }
        .container-s {
            padding: 50px;
            background-color: #ffffffd4;
            border-radius: 10px; /* Add border radius to the container */
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1); /* Add shadow for visual effect */
            margin-bottom: 20px; /* Add bottom margin for spacing */
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
            background-color: #ffffff; /* White background color */
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1); /* Add shadow for visual effect */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 25px; /* Add radius to the table */
            overflow: hidden; /* Avoid overflow from the corners given the radius */
            border: transparent; /* Border for the entire table */
        }
        .table th, .table td {
            padding: 12px 15px;
            border: none; /* Remove individual border */
            text-align: center;
            font-size: 16px;
        }
        .table th {
            background-color: #51b7c8; /* Green background color */
            color: white; /* White text color */
        }
        .table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .btn {
            border-radius: 25px;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Add space between buttons */
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
                        <a href="/buku/tambah" class="btn btn-primary">Tambah Buku</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-s">
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
                        <div class="action-buttons">
                            <a href="/buku/edit/{{ $buku->id }}/edit" class="btn btn-light"> <i class="fas fa-pen"></i> Edit</a>
                            <a href="/buku/detail/{{ $buku->id }}/show" class="btn btn-dark"> <i class="fas fa-newspaper"></i> Detail</a>
                            <form action="/buku/tampilan/{{ $buku->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bukus->links() }}
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
    <script>
        // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
        changePageTitle("Halaman Data Buku");
    </script>
</body>
</html>
