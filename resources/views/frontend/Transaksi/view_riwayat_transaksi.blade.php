@extends('Frontend.template')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('/')}}img/banner2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-dark">Riwayat Transaksi</h2>
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
    <section>
        <div class="container-fluid pt-10">
            <div class="row px-xl-18">
                <div class="col-md-2"></div>
                <div class="col-lg-8 ">
                    <div class="checkout__order">
                        {{-- @dd($riwayat); --}}
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-bold"><a  href="{{route('detail-riwayat-transaksi')}}">Invoice</a></h6>
                                <h6>Belum Melakukan Pembayaran</h6>
                            </div>
                            <div class="row">
                                <table class="table">
                                    <tr >
                                        <td><img src="{{asset('/')}}gambar/bonsai.jpg" alt="" style="width: 50px;">Pot Bunga Ornamen Buatan Plastik Panjangan Dekorasi </td></td>
                                        <td>Rp.25000</td>
                                    </tr>


                                </table>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h6 class="font-weight-bold">Total Pesanan</h6>
                                <h6 style="width: 16%">Rp. 25000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
@endsection
