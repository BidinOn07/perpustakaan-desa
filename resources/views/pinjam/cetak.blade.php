<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="'scrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            border-collapse: collapse;
            width: 95%;
            margin: 0 auto;
        }
        table.static th, table.static td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        table.static th {
            background-color: #f2f2f2;
        }
    </style>
    <title>CETAK DATA PEminjam</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>LAPORAN DATA PEMINJAM</b></p>
        <table class="static" align="center">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Nama</th>
                    <th style="width: 10%;">Nama Buku</th>
                    <th style="width: 15%;">Alamat</th>
                    <th style="width: 15%;">No Hp</th>
                    <th style="width: 10%;">Tanggal pinjam</th>
                    <th style="width: 10%;">Tanggal Wajib kembali</th>
                    <th style="width: 10%;">Tanggal Pengembalian</th>

                </tr>
            </thead>
            <tbody>
                @foreach($peminjam as $cetak)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cetak->nama_peminjam }}</td>
                    <td>{{ $cetak->bukus->judul }}</td>
                    <td>{{ $cetak->alamat }}</td>
                    <td>{{ $cetak->no_hp }}</td>
                    <td>{{ $cetak->tanggal_pinjam }}</td>
                    <td>{{ $cetak->tanggal_wajib_kembali}}</td>
                    <td>{{ $cetak->tanggal_pengembalian}}</td>
                    {{-- <td>{{ $cetak->id_buku }}</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <script type = "text/javascript">
        window.print();
        </script> --}}
</body>
</html>
