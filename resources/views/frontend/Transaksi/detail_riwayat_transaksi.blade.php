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
    <div class="container-fluid pt-10">
        <div class="row px-xl-18">
            <div class="col-md-2"></div>
            <div class="col-lg-8">
                <div class="checkout__order">
                    <div class="">
                        <h4 class="font-weight-semi-bold m-0">Detail Transaksi</h4>
                    </div>

                    <div class="checkout__order">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-bold">Invoice :</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Alamat Pengiriman</h6>
                                    <h6 class="font-weight-medium"></h6>
                                    <h6 class="font-weight-medium"></h6>
                                    <h6 class="font-weight-medium"></h6>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Kurir</h6>
                                    <h6 class="font-weight-medium"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pesanan</h5>
                            <h6 class="font-weight-bold"></h6>
                        </div>
                        <table class="table">

                                <tr>
                                    <td style="width: 70%"><img src="" alt="" style="width: 50px;"> </td>
                                    <td><b>pcs</b> </td>
                                    <th>:</th>
                                    <td>Rp.</td>
                                </tr>

                        </table>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pembayaran</h5>
                        </div>
                            <table class="table">
                                <tr>

                                    <th style="width: 80%">Sub Total Produk</th>
                                    <th>:</th>
                                    <td>Rp.</td>
                                </tr>
                                <tr>
                                    <th style="width: 80%">Ongkir</th>
                                    <th>:</th>
                                    <td >Rp.</td>
                                </tr>
                                <tr>
                                    <th style="width: 80%">Total belanja</th>
                                    <th>:</th>
                                    <td >Rp.</td>
                                </tr>
                            </table>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Pembayaran</h5>
                        </div>
                        <table class="table">
                            <tr>
                                <th style="width: 80%">Metode Pembayaran</th>
                                <th>:</th>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pengiriman Barang</h5>

                        </div>
                        <div class="table">
                            <h5 id="no_resi"></h5>
                            <h5 id="status"></h5>
                            <ul class="list-group" id="history">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
