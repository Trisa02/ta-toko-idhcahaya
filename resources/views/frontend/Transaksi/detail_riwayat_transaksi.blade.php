@extends('frontend.template')
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
                        <h6 class="font-weight-bold">Invoice : {{$transaksi->order_id}}</h6>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Alamat Pengiriman</h6>
                                    <h6 class="font-weight-medium">{{$member->alamat_member}}</h6>
                                    <h6 class="font-weight-medium">No Telepon : {{$member->no_telepon}}</h6>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Kurir</h6>
                                    <h6 class="font-weight-medium">{{$transaksi->kurir}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pesanan</h5>
                            <h6 class="font-weight-bold"></h6>
                        </div>
                        <table class="table">
                                @php
                                    $sub_total=0;
                                @endphp
                                @foreach ($detail as $item)
                                    <tr>
                                        <td style="width: 70%"><img src="{{asset('gambar/'.$item->gambar)}}" alt="" style="width: 50px;">{{$item->nama_barang}}</td>
                                        <td><b>{{$item->qty}}pcs</b> </td>
                                        <th>:</th>
                                        <td>Rp.{{number_format($item->harga)}}</td>
                                    </tr>
                                    @php
                                        $sub_total += $item->total;
                                    @endphp
                                @endforeach
                        </table>

                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pembayaran</h5>
                        </div>
                            <table class="table">
                                <tr>

                                    <th style="width: 80%">Sub Total Produk</th>
                                    <th>:</th>
                                    <td>Rp.{{number_format($sub_total)}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 80%">Ongkir</th>
                                    <th>:</th>
                                    <td >Rp.{{number_format($transaksi->ongkir)}}</td>
                                </tr>
                                <tr>
                                    <th style="width: 80%">Total belanja</th>
                                    <th>:</th>
                                    <td >Rp.{{$transaksi->total_bayar}}</td>
                                </tr>
                            </table>

                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Pembayaran</h5>
                        </div>
                        <table class="table">
                            <tr>
                                <th style="width: 80%">Metode Pembayaran</th>
                                <th>:</th>
                                <td>{{$transaksi->payment_type}}</td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Rincian Pengiriman Barang</h5>
                            @if ($transaksi->nomor_resi == null)
                                <h6 class="text-center"><i class="text-danger"><i class="fa fa-times"></i> Nomor Resi Belum Diinput</i></h6>
                            @else
                                <button id="lacak" type="button" style="height:50px;width:200px"  class="btn btn-success btn-md"><i class="fa fa-search"></i> LACAK BARANG</button>
                                {{-- <a href="{{route('lacak-barang')}}">Lacak</a> --}}
                            @endif
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
    <br>
    <script>
        $('#lacak').click(function (e) {
            $('#history').html('');
            e.preventDefault();
            var  invoice = '{{$transaksi->order_id}}';
            $.ajax({
            type: "post",
            url: '{{route("lacak-barang")}}',
            data : {
                invoice : invoice,
            },
            dataType: "json",
            success: function (response) {
                if(response.status == 'ok'){
                    $('#no_resi').html('No. Resi : '+ response.summary.awb)
                    $('#status').html('Status : '+ response.summary.status)
                    var history = response.history;
                    var list = '';
                    history.forEach(element => {
                        list += `<li><b>${element.date}</b>  ${element.desc}</li>`;
                    });
                    $('#history').append(list);
                }
            }
        });

        });

    </script>
@endsection
