@extends('frontend.template')
@section('content')
<style>
    .button {
      background-color: #ffffff; /* putih */
      border: none;
      color: black;
      padding: 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .button1 {border-radius: 2px;}
    .button2 {border-radius: 4px;}
    .button3 {border-radius: 8px;}
    .button4 {border-radius: 12px;}
    .button5 {border-radius: 50%;}
</style>

<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all" data-toggle="collapse" href="#navbar-vertical" style="height: 50px; margin-top: 1px; padding: 1 30px;">
                        <i class="fa fa-bars"></i>
                        <span>Kategori Produk</span>
                    </div>
                    <nav class="collapse show navbar navbar-vertical  align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical" style="overflow: scroll">
                        <div class="navbar-nav w-100" style="height: 400px;">
                            <ul>
                                <li>
                                    @foreach ($kategori as $ktr)
                                        <a href="{{route('produk-perkategori',$ktr->slug_kategori)}}" class="nav-item nav-link">{{$ktr->nama_kategori}}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form id="form" class="row g-3" method="get" action="{{route('index-frontend')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-8">
                                <input type="text" name="tnama" id="tnama"  placeholder="What do yo u need?">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" onclick="cariBarang()" id="btnCari" class="site-btn">SEARCH</button>
                            </div>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+62 83193730772</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="{{asset('/')}}logincss/images/TOKO.png">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="featured spad">
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Belanja Produk</h2>
                    </div>
                </div>
            </div>
        <div class="row featured__filter">
            @foreach ($barang as $brg)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset('gambar/'.$brg->gambar)}} " width="100%" alt="">
                            <ul class="featured__item__pic__hover">
                                <li><a href="{{route('detail-barang',$brg->slug_barang)}}" data-toggle="tooltip" data-placement="right" title="Detail"><i class="fa fa-eye"></i></a></li>
                                <li>
                                    <form action="{{route('simpan-keranjang')}}" method="post"  enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_barang" value="{{$brg->id_barang}}" >
                                        <input type="hidden" name="tanggal" id="tanggal" >
                                        <input type="hidden" name="qty" id="qty" value="1" >
                                        <input type="hidden" name="total" id="total">
                                        <button class="button button5" data-toggle="tooltip" data-placement="right" title="Keranjang"><i class="fa fa-shopping-cart" style="black"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$brg->nama_barang}}</a></h6>
                            <h5>Rp.{{number_format($brg->harga)}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>


<script>

    function cariBarang() {

        var nama = $('#tnama').val();


        if (nama == '') {
            alert('Masukan Nama Produk Terlebih Dahulu !')
        } else if (nama != '') {
            var namabarang = nama;

        } else {
            var namabarang = nama;
            alert('Barang yang anda cari tidak ditemukan')
        }
        $('#caribarang').load("/cari-barang/" + namabarang)
    }

</script>
@endsection
