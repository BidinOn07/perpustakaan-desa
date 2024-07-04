<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>Manajemen Perpustakaan</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-kit.css?v=3.0.4') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <style>
        .form-control-solid {
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.5rem 1rem;
            color: #495057;
        }
    </style>
</head>
<body>
    <!-- Navbar Transparent -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/BUK.jpeg') }}" alt="Logo" style="height: 50px;">
            </a>
            </ul>
            {{-- <li class="nav-item">
                <a class="nav-link" href="/buku/tampilan">Buku</a>
            </li> --}}
        </div>

        <li class="nav-item">
            <a class="nav-link"id="attinButton" type="submit" class="">Register</a>
        </li>
        <!-- Move the login button here -->
        {{-- <button id="attinButton" type="submit" class="">Register</button> --}}

        </ul>
    </nav>

    <!-- Header -->
    <header class="header-7">
        <div class="page-header min-vh-100" style="background-image: url('{{ asset('img/blue.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center">
                        <p class="text-white opacity-8">Formulir Pengunjung</p>
                        <h2 class="text-white mt-4">HAI! SILAHKAN ISI DATA PENGUNJUNG</h2>
                        <form action="/tambah" method="POST" class="mt-4">
                            @csrf
                            <div class="form-group">
                                <label for="nama" class="text-white">Nama:</label>
                                <input type="text" id="nama" name="nama" class="form-control form-control-solid" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="text-white">Alamat:</label>
                                <input type="text" id="alamat" name="alamat" class="form-control form-control-solid" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Core JS Files -->
    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="{{ asset('js/plugins/countup.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js?v=3.0.4') }}" type="text/javascript"></script>
    <!-- Google Maps Plugin -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script>
        document.getElementById("attinButton").onclick = function() {
            window.location.href = "{{ route('auten.register') }}";
        };
    </script>
</body>
</html>
