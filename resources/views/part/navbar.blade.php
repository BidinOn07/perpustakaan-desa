    <!-- Navbar Transparent -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
        <div class="container">
            <style>

                /* Gaya untuk teks berwarna putih */
                .navbar-nav .nav-link,
                .btn-outline-danger {
                    color:
                    #FFFC57 !important
                }
                .navbar-nav .nav-link:hover,
                .btn-outline-danger:hover {
                  color: #ffffff !important;
              }
            </style>
        </button>
        <!-- Navbar links -->
        @auth

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item" >
                    <a class="nav-link"  href="/home"> Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/buku/tampilan">Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pinjam/tampilan">Peminjaman</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link"  href="/datapinjam">Data Pinjam </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/tampilan">User</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link"  href="/pengunjung/tampilan">Pengunjung </a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link"  href="/kategori"> Kategori </a>
                </li>
                <form action="/" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="color: white;">
                        <i class="bi bi-lock"></i> Logout
                      </button>
                </form>
            </ul>
        </div>
        @endauth
            </div>
        </div>
    </nav>
