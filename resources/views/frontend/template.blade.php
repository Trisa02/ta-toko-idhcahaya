<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IDH.CAHAYA</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('/')}}css/style.css" type="text/css">
    {{-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script> --}}
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Page Preloder -->

    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/profile.php?id=100072698470651"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/idh.cahaya/"><i class="fa fa-instagram"></i></a>
                                <a href="whatsapp://send?text=Hello&phone=+6282268141161"><i class="fa fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            @if (session('id') == null)
                                <div class="header__top__right">
                                    <div class="header__top__right__social">
                                        <a href="{{route('login-member')}}"><i class="fa fa-user"></i> Login</a>
                                    </div>
                                    <div class="header__top__right__auth">
                                        <a href="{{route('register-member')}}"><i class="fa fa-registered"></i> Register</a>
                                    </div>
                                </div>
                            @else
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="{{route('view-akun')}}"><i class="fa fa-user"></i>Akun</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i>Logout</a>
                                </div>
                                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route('logout')}}" method="post">
                                            @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Silahkan klik tombol logout untuk mengakhiri.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success" >Logout</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <span class="text-muted px-2">|</span>
                                <div class="header__top__right__auth">
                                    <a href="{{route('view-riwayat-transaksi')}}"><i class="fa fa-history"></i> Riwayat Transaksi</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="">Idh.Cahaya</a></li>
                            <li><a href="{{route('index-frontend')}}">Home</a></li>
                            <li><a href="">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{route('view-akun')}}">Akun</a></li>
                                    <li><a href="{{route('view-riwayat-transaksi')}}">Riwayat Transaksi</a></li>
                                    <li><a href="{{route('view-keranjang')}}">Keranjang</a></li>
                                    {{-- <li><a href="{{route('coba')}}">Coba</a></li> --}}
                                </ul>
                            </li>
                            <li><a href="whatsapp://send?text=Hello&phone=+6282268141161">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    @auth
                        <div class="header__cart">
                            <ul>
                                <li><a href="{{route('view-keranjang')}}" data-toggle="tooltip" data-placement="right" title="Keranjang Saya"><i class="fa fa-shopping-bag"></i> <span>{{$jumlah}}</span></a></li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @yield('content')
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <b>Kontak Kami</b>
                        </div>

                        <ul>
                            <li>Address: Kp.Tarandam,Kecamatan Bonjol, Kabupaten Pasaman, Sumatera Barat</li>
                            <li>Phone: +62 83193730772</li>
                            <li>Email: id_cahaya@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Temui Kami Juga di</h6>
                        <div class="footer__widget__social">
                            <a href="https://www.facebook.com/profile.php?id=100072698470651"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/idh.cahaya/"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script async type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-QYR4W078nsRZZgzS"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('/')}}js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}js/jquery.nice-select.min.js"></script>
    <script src="{{asset('/')}}js/jquery-ui.min.js"></script>
    <script src="{{asset('/')}}js/jquery.slicknav.js"></script>
    <script src="{{asset('/')}}js/mixitup.min.js"></script>
    <script src="{{asset('/')}}js/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="main.js"></script>
    {{-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script> --}}
    @stack('script')


</body>

</html>
