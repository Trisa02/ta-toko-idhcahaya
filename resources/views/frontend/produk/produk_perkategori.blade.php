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
                            <li><a href="{{route('detail-barang',$dk->slug_barang)}}" data-toggle="tooltip" data-placement="right" title="Detail"><i class="fa fa-eye"></i></a></li>
                            <li>
                                <form action="{{route('simpan-keranjang')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_barang" value="{{$dk->id_barang}}" >
                                <input type="hidden" name="tanggal" id="tanggal" >
                                <input type="hidden" name="qty" id="qty" value="1" >
                                <input type="hidden" name="total" id="total">
                                <button class="button button5" data-toggle="tooltip" data-placement="right" title="Keranjang"><i class="fa fa-shopping-cart" style="black"></i></button>
                                </form>
                            </li>
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
