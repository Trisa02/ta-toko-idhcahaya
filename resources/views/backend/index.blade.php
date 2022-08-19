<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin IDH.Cahaya</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('/')}}backend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('/')}}backend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/')}}backend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/')}}backend/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">IDH.CAHAYA</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="{{route('dashboard')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    @if (session('level_user') == 'admin')
                    <a href="{{route('view-admin')}}" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Admin</a>
                    @endif
                    @if (session('level_user') == 'karyawan' || session('level_user') == 'admin' )
                    <a href="{{route('view-kategori')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>KategoriProduk</a>
                    <a href="{{route('view-barang')}}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>Barang</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-cart-plus me-2"></i>Transaksi</a>
                    @endif
                    @if (session('level_user') == 'admin')
                    <a href="form.html" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Laporan Penjualan</a>
                    @endif
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('gambar/'. $admin->gambar)}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{$admin->nama_admin}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{route('profil-admin')}}" class="dropdown-item">My Profile</a>
                            <form id="formLogout" action="{{route('admin-logout')}}" method="post">
                                @csrf
                                <a onclick="logout()"  href="#" class="dropdown-item">Logout</a>
                            </form>
                            <script>
                                function logout()
                                {
                                    $('#formLogout').submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Navbar End -->
            @yield('content')

            <!-- Sale & Revenue Start -->

            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->

            <!-- Recent Sales End -->


            <!-- Widgets Start -->

            <!-- Widgets End -->


            <!-- Footer Start -->

            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/chart/chart.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/easing/easing.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ asset('/')}}backend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('/')}}backend/js/main.js"></script>
</body>

</html>
