@extends('frontend.template')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('/')}}img/banner2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-dark">Detail Transaksi</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index-frontend')}}">Home</a>
                            <a href="./index.html">Keranjang Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <div class="container-fluid pt-10">
        <div class="row px-xl-18">
            <div class="col-md-2"></div>
            <div class="col-lg-8">
                <div class="checkout__order">
                    <div class="">
                        <h4 class="font-weight-semi-bold m-0">Detail Transaksi</h4>
                    </div>

                    <div class="checkout__order">
                        <h6 class="font-weight-bold">Invoice : {{$selesai->order_id}}</h6>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Alamat Pengiriman</h6>
                                    <h6 class="font-weight-medium">{{$user->nama_member}}</h6>
                                    <h6 class="font-weight-medium">{{$user->alamat_member}}</h6>
                                    <h6 class="font-weight-medium">{{$user->no_telepon}}</h6>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Kurir</h6>
                                    <h6 class="font-weight-medium">{{$selesai->kurir}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Barang</h5>
                            <h6 class="font-weight-bold"></h6>
                        </div>
                        <table class="table">
                            @php
                                $sub_total = 0;
                            @endphp
                                @foreach ($keranjang as $item)
                                    <tr>
                                        <td style="width: 70%"><img src="{{asset('gambar/'.$item->gambar)}}" alt="" style="width: 50px;">{{$item->nama_barang}}</td>
                                        <td><b>{{$item->qty}}pcs</b> </td>
                                        <th>:</th>
                                        <td>Rp.{{number_format($item->harga)}}</td>
                                    </tr>
                                    @php
                                        $sub_total+=$item->harga;
                                    @endphp
                                @endforeach
                        </table>

                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pesanan</h5>
                        </div>
                            <table class="table">
                                <tr>
                                    <th style="width: 80%">Sub Total Produk</th>
                                    <th>:</th>
                                    <td>Rp.{{$sub_total}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 80%">Ongkir</th>
                                    <th>:</th>
                                    <td >Rp.{{number_format($selesai->ongkir)}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 80%">Total belanja</th>
                                    <th>:</th>
                                    <td >Rp.{{number_format($selesai->total_bayar)}}</td>
                                </tr>
                            </table>

                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Pembayaran</h5>
                        </div>
                        <table class="table">
                            <tr>
                                <th style="width: 80%">Metode Pembayaran</th>
                                <th>:</th>
                                <td>{{$selesai->payment_type}}</td>
                            </tr>
                            <tr>

                                <th style="width: 80%">Status Pembayaran</th>
                                <th>:</th>
                                <td>
                                    @if ($selesai->transaction_status == 'settlement')
                                        Sudah Melakukan Pembayaran
                                     @else
                                        Menunggu Pembayaran
                                    @endif
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
