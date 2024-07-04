@include('layouts.welcome')
@include('part.navbar')
<!doctype html>
<html lang="en">
<head>
    <header class= "coba">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('font/css/all.css') }}">

        <section class="content">
            <div class="container-fluid">
                <style>
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
            box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.1); /* Add shadow for visual effect */
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
<div class="container-s">
<body>
    <table id="table" class="table table-bordered table-hover">
        <div class="row justify-content-center static-top">
            <div class="col-md-6">
                <form action ="/pinjam/tampilan">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">search</button>
                    </div>
                </form>
            </div>
        </div>
            <thead>
                <tr>
                    <th style="width: 10%;" onclick="sortTable(0)">No</th>
                    <th style="width: 15%;">Judul Buku <i class="fas fa-sort sortable-icon" onclick="sortTable(1)"></i>
                    </th>
                    <th style="width: 15%;">Kategori<i class="fas fa-sort sortable-icon" onclick="sortTable(2)"></i>
                    </th>
                    <th style="width: 15%;">Sampul</th>
                    <th style="width: 10%;">Kode Buku</th>
                    <th style="width: 10%;">Total Buku <i class="fas fa-sort sortable-icon" onclick="sortTable(5)"></i>
                    </th>
                    <th style="width: 10%;">Stok <i class="fas fa-sort sortable-icon" onclick="sortTable(6)"></i> </th>
                    <th style="width: 10%;">Pembaca <i class="fas fa-sort sortable-icon" onclick="sortTable(7)"></th>
                    <th style="width: 15%;">Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->kategori->nama }}</td>
                        <td><img src="{{ url(Storage::url($buku->gambar)) }}" alt="Image Preview" class="inline-block"
                                style="max-width: 100px; max-height: 100px;"></td>
                        <td>{{ $buku->kode_buku }}</td>
                        <td>{{ $buku->total_buku }}</td>
                        <td>{{ $buku->stok }}</td>
                        <td> {{ $buku->baca->count() }}</td>
                        <td>
                            <a href="/pinjam/pinjams?id={{ $buku->id }}&judul={{ $buku->judul }}"
                                class="btn btn-dark">
                                <i class="fa-solid fa-calendar-week"></i> Pinjam
                            </a>
                            {{-- <a href="{{ route('pembaca.baca', ['kategori_id' => $buku->kategori_id, 'buku_id' => $buku->id]) }}" class="btn btn-primary">Baca</a> --}}
                            <form
                                action="{{ route('pembaca.baca', ['kategori_id' => $buku->kategori_id, 'buku_id' => $buku->id]) }}"
                                method="post" class="d-inline">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('APA INI DI BACA?')">
                                    Baca
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            <!-- Your JavaScript code -->
            <script>
                // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
                changePageTitle("Halaman Informasi Peminjaman");
            </script>

            <script>
                var sortAscending = true;
                var lastSortedColumn = 0;

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
                            var xValue = x.textContent || x.innerText;
                            var yValue = y.textContent || y.innerText;
                            if (sortAscending) {
                                if (xValue.toLowerCase() > yValue.toLowerCase()) {
                                    shouldSwitch = true;
                                    break;
                                }
                            } else {
                                if (xValue.toLowerCase() < yValue.toLowerCase()) {
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
                    if (lastSortedColumn === col) {
                        sortAscending = !sortAscending;
                    } else {
                        sortAscending = true;
                        lastSortedColumn = col;
                    }
                }
            </script>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-baca').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/baca', // Ubah URL sesuai dengan rute Anda
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Perbarui tabel pembaca dengan data pembaca yang diperbarui
                    // Di sini Anda akan memperbarui tampilan tabel dengan data yang diterima dari respons server
                    // Misalnya, jika respons adalah objek JSON yang berisi total pembaca baru, Anda dapat memperbarui kolom yang sesuai di tabel pembaca.
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

</html>
