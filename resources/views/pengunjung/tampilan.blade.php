@include('layouts.welcome')
@section('title', 'Tambah Buku')
@include('part.navbar')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('font/css/all.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
<header style="padding-top: 1px;">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <div class="input-group mb-3">
                    <a href="/pengunjung/tambah" class="btn btn-primary"></i> Tambah Pengunjung</a>
                </div>
            </div>
            <div class="col-auto"> <!-- Menggunakan col-auto agar tombol cetak hanya menggunakan ruang yang dibutuhkan -->
                <div class="input-group mb-3">
                    <a href="/pengunjung/cetakk" class="btn btn-primary">Cetak</a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container-s">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/pengunjung/tampilan" enctype="multipart/form-data">
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
                        <th style="width: 25%;">Nama <i class="fas fa-sort sortable-icon" onclick="sortTable(1)"></i></th>
                        <th style="width: 25%;">Alamat <i class="fas fa-sort sortable-icon" onclick="sortTable(2)"></i></th>
                        <th style="width: 25%;">Tanggal <i class="fas fa-sort sortable-icon" onclick="sortTable(3)"></i></th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengunjungs as $pengunjung)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengunjung->nama }}</td>
                        <td>{{ $pengunjung->alamat }}</td>
                        <td>{{ $pengunjung->created_at }}</td>
                        <td>
                            <form action="/pengunjung/tampilan/{{ $pengunjung->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin di hapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </div>
        </table>
        <!-- Your JavaScript code -->
        <script>
            // Panggil fungsi changePageTitle dengan judul halaman yang sesuai
            changePageTitle("Halaman Data Pengunjung");
        </script>
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


        {{  $pengunjungs->links() }}
    </body>
    </html>
