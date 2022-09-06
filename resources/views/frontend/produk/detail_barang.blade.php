@extends('frontend.template')
@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('/')}}img/banner2.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2 class="text-dark">Detail Produk</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('index-frontend')}}">Home</a>
                        <a href="./index.html">Detail Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('pesan'))
                <div class="alert alert-danger">
                    {{ session('pesan') }}
                </div>
            @endif
            </div>
            <div class="col-lg-4 col-md-4">
                @foreach ($detail as $dtl)
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{asset('gambar/'.$dtl->gambar)}}" alt="">
                    </div>
                    {{-- <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="img/product/details/product-details-2.jpg"
                            src="img/product/details/thumb-1.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-3.jpg"
                            src="img/product/details/thumb-2.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-5.jpg"
                            src="img/product/details/thumb-3.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-4.jpg"
                            src="img/product/details/thumb-4.jpg" alt="">
                    </div> --}}
                </div>
                @endforeach
            </div>
            @foreach ($detail as $dtl)
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$dtl->nama_barang}}</h3>
                        <div class="product__details__price">Rp.{{number_format($dtl->harga)}}</div>
                        <p>{{$dtl->detail}}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="">
                                    <input type="number" id="input-qty" min="1" value="1" class="form-control mb-3" style="width: 40%">
                                </div>
                            </div>
                        </div>
                        <form action="{{route('simpan-keranjang')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{$dtl->id_barang}}" >
                            <input type="hidden" name="tanggal" id="tanggal" >
                            <input type="hidden" name="qty" id="qty" value="1" >
                            <input type="hidden" name="total" id="total">
                            <button class="primary-btn plus float-right" data-toggle="tooltip" data-placement="right" title="Keranjang">Keranjang</button>
                        </form>
                        {{-- <a href="#" class="heart-icon" data-toggle="tooltip" data-placement="right" title="Favorit"><span class="icon_heart_alt"></span></a> --}}
                        <form action="{{route('simpan-beli')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{$dtl->id_barang}}" >
                            <input type="hidden" name="tanggal" id="tanggal" >
                            <input type="hidden" name="qty" id="qty-langsung" value="1" >
                            <input type="hidden" name="total" id="total">
                            <button class="primary-btn" data-toggle="tooltip" data-placement="right" title="Beli Sekarang">Buy Now</button>
                        </form>
                        {{-- <a href="{{route('view-belilangsung')}}" class="primary-btn" data-toggle="tooltip" data-placement="right" title="Beli Sekarang">Buy Now</a> --}}

                        <ul>
                            <li><b>Stok Produk</b> <span>{{$dtl->stok}} tersedia </span></li>
                            <li><b>Berat</b> <span>{{$dtl->berat}} gram</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/profile.php?id=100072698470651"><i class="fa fa-facebook"></i></a>
                                    <a href="https://www.instagram.com/idh.cahaya/"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-whatsapp"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

@push('script')
<script>
    $('#input-qty').change(function(e){
        e.preventDefault();
        var input_qty = $(this).val();
        $('#qty-langsung').val(input_qty);
    })
</script>

@endpush
@endsection
