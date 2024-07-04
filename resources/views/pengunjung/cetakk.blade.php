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
    <title>CETAK DATA PENGUNJUNG</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>LAPORAN DATA PENGUNJUNG</b></p>
        <table class="static" align="center">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama</th>
                    <th style="width: 25%;">Alamat</th>
                    <th style="width: 25%;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengunjungcetak as $cetak)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cetak->nama }}</td>
                    <td>{{ $cetak->alamat }}</td>
                    <td>{{ $cetak->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type = "text/javascript">
        window.print();
        </script>
</body>
</html>
