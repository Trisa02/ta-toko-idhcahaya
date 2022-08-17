@extends('frontend.template')
@section('content')
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
            @foreach ($detail_kategori as $dk)
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('gambar/'.$dk->gambar)}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Favorit"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{route('detail-barang',$dk->slug_barang)}}" data-toggle="tooltip" data-placement="right" title="Detail"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Keranjang"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{$dk->nama_barang}}</a></h6>
                        <h5>Rp.{{number_format($dk->harga)}}</h5>
                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </div>
</section>
@endsection
