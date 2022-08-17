@extends('frontend.template')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('/')}}img/banner2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-dark">Keranjang Belanja</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index-frontend')}}">Home</a>
                            <a href="./index.html">Keranjang Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Produk</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjang as $krj)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{asset('gambar/'.$krj->gambar)}}" alt="" style="width: 70px;">
                                            <h5>{{$krj->nama_barang}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            Rp.{{number_format($krj->harga)}}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <a href="{{route('quantity-kurang',[$krj->id_keranjang,$krj->id_barang])}}" class="btn btn-sm btn-success"><i class="fa fa-minus"></i></a>
                                                </div>
                                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{$krj->qty}}">
                                                <div class="input-group-btn">
                                                    <a href="{{route('quantity-tambah',[$krj->id_keranjang,$krj->id_barang])}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            Rp.{{number_format($krj->total)}}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{route('hapus-keranjang',$krj->id_keranjang)}}" class="btn btn-sm btn-success"><span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route('checkout-barang')}}" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>Checkout</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
