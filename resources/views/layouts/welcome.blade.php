<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('/img/logo.png')}}" rel="icon">
    {{-- <title id="page-title">Sistem Informasi Perpustakaan</title> --}}
    <!-- Fonts -->
    <link href="{{ asset('img/bg9.jpg')}}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/style.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/template/css/ruang-admin.min.css')}}" rel="stylesheet">
    <link href="{{asset('/template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <style>
         h1 {
            color: white; /* Tulisan h1 menjadi putih */
        }
    </style>
  
</head>
<body>
<!--Header starts-->
<div class="header">
    <!--Content before waves-->
    <div class="inner-header flex">
        <h1 id="page-title">Manajemen Data Perpustakaan</h1>

        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>
    <!--Waves end-->
</div>
<!--Header ends-->

<!--Content starts-->
@yield('content')

<!-- Your JavaScript code -->
<script>
// Fungsi untuk mengubah judul header sesuai dengan nama halaman
function changePageTitle(pageName) {
  document.getElementById('page-title').innerText = pageName;
}

// Panggil fungsi changePageTitle dengan nama halaman yang sesuai
// Misalnya, jika halaman berubah menjadi "Profile Page", maka panggil:
// changePageTitle("Profile Page");
</script>
</body>
</html>
