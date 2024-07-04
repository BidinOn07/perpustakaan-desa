@include('layouts.welcome')
@section('title', 'Tambah Buku')
@include('part.navbar')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Custom styles for better appearance */
        .card {
            margin-bottom: 90px;
        }

        .card-header {
            background-color: #51b7c8;
            color: white;
        }

        .chart-container {
            padding: 90px;
        }

        .checkbox-container {
            margin-bottom: 20px;
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

        .form-select,
        .btn-primary {
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

        .table th,
        .table td {
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

        @media (max-width: 500px) {
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
    <div class="container-fluid">
        <header style="padding-top: 1px; padding-right: 15px;">
            <div class="row justify-content-end">
                <div class="col-3">
                    <button id="downloadJpg" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate JPG
                    </button>
                </div>
            </div>
        </header>
        <div class=" chart-container">
        <div class="row mb-4">
            <div class="col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Buku</h6>
                    </div>
                    <div class="card-body">
                        <div id="chartBukuDiv">
                            {!! $chartBuku->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Baca</h6>
                    </div>
                    <div class="card-body">
                        <div id="chartBacaDiv">
                            {!! $chartBaca->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Pilih Grafik untuk Diunduh:</h6>
                    </div>
                    <div class="card-body">
                        <label><input type="checkbox" id="selectPengunjung" checked> Data Pengunjung</label><br>
                        <label><input type="checkbox" id="selectBuku" checked> Data kategori peminjaman</label><br>
                        <label><input type="checkbox" id="selectBaca" checked> Data Pembaca</label><br>
                        <label><input type="checkbox" id="seelectPeminjaman" checked> Data Peminjaman</label><br>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div style="padding: 90px; padding-right: 15px;"> --}}

        <div class="row justify-content-center">
            <!-- Area Chart Pengunjung -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung</h6>
                    </div>
                    <div class="card-body">
                        <div id="chartPengunjungDiv">
                            {!! $chartPengunjung->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart Peminjaman -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
                    </div>
                    <div class="card-body">
                        <div id="chartPeminjamanDiv">
                            {!! $chartPeminjaman->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

        <!-- Chart scripts -->
        {!! $chartPengunjung->script() !!}
        {!! $chartBuku->script() !!}
        {!! $chartBaca->script() !!}
        {!! $chartPeminjaman->script() !!}

        <!-- html2canvas script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

        <script>
            function downloadImage(type) {
                const selectedCharts = [];

                if (document.getElementById('selectPengunjung').checked) {
                    selectedCharts.push(html2canvas(document.querySelector("#chartPengunjungDiv")));
                }
                if (document.getElementById('selectBuku').checked) {
                    selectedCharts.push(html2canvas(document.querySelector("#chartBukuDiv")));
                }
                if (document.getElementById('selectBaca').checked) {
                    selectedCharts.push(html2canvas(document.querySelector("#chartBacaDiv")));
                }
                if (document.getElementById('selectPeminjaman').checked) {
                    selectedCharts.push(html2canvas(document.querySelector("#chartPeminjamanDiv")));
                }

                Promise.all(selectedCharts).then((canvases) => {
                    canvases.forEach((canvas, index) => {
                        const link = document.createElement('a');
                        link.download = `chart-${index + 1}.${type}`;
                        link.href = canvas.toDataURL(`image/${type}`);
                        link.click();
                    });
                });
            }

            document.getElementById('downloadJpg').addEventListener('click', function () {
                downloadImage('jpeg');
            });
        </script>
    </body>
    </html>
