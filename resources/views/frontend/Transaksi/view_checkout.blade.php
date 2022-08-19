@extends('Frontend.template')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('/')}}img/banner2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-dark">Checkout Barang</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index-frontend')}}">Home</a>
                            <a href="./index.html">Keranjang Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <div class="container-fluid pt-5">
            <div class="checkout__form">
                <h4>Detail Belanja</h4>
                <form action="#">
                    <div class="row px-xl-5">
                        <div class="col-lg-8">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Produk</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $sub_total = 0;
                                    @endphp
                                    @foreach ($checkout as $ck)
                                        <tbody>
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img src="{{asset('gambar/'.$ck->gambar)}}" alt="" style="width: 70px;">
                                                    <h5>{{$ck->nama_barang}}</h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    Rp.{{number_format($ck->harga)}}
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                                        <h5>{{$ck->qty}} barang</h5>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    Rp.{{number_format($ck->total)}}
                                                </td>
                                            </tr>
                                        </tbody>
                                        @php
                                            $sub_total += $ck->total;
                                        @endphp
                                    @endforeach
                                </table>
                                <div class="card-footer  bg-transparent">
                                    <div class="d-flex justify-content-between mt-2">
                                        <h5 class="font-weight-bold">Sub Total</h5>
                                        <h5 class="font-weight-bold">Rp.{{number_format($sub_total)}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Ongkos Kirim</h4>
                                <div class="d-flex justify-content-between mb-3 pt-1">
                                    <h6 class="font-weight-bold">Pilih Pengiriman</h6>
                                </div>
                                @php
                                    $city = DB::table('cities')->where('city_id', Auth::user()->city_destination)->first();
                                    // $city = DB::table('members')->where('id',Auth::user()->alamat_member)->first();
                                    // dd($city);
                                @endphp
                                <div class="form-group" style="display: none">
                                    <label class="font-weight-medium">Alamat Toko</label>
                                    <select class="form-control kota-asal" style="width:100%"  name="city_origin" disabled>
                                        <option value="399">Pasaman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Kota / Kabupaten Tujuan</label>
                                    <label class="font-weight-medium">{{$member->alamat_member}}</label>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="font-weight-medium">Kota / Kabupaten Tujuan</label>
                                    <label class="font-weight-medium">{{$member->alamat_member}}</label>
                                    <select class="form-control kota-tujuan" name="city_destination" style="width:100%" disabled>
                                        <option value="{{$city->city_id}}">{{$city->name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-weight-bold">Kurir</label><br>
                                            <select class="form-control btn-check" name="courier" style="">
                                                <option value="0">--Pilih Kurir--</option>
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS</option>
                                                <option value="tiki">TIKI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="form-ongkir">
                                    <div class="col-md-12">
                                        <div class="card d-none ongkir">
                                            <div class="card-body">
                                                <div class="form-group" id="ongkir">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold">Total Pembayaran</h5>
                                </div>
                                @php
                                    $sub_total = 0;
                                @endphp
                                @foreach ($checkout as $ck)
                                    @php
                                        $sub_total +=$ck->total;
                                        // $total_belanja=$sub_total+$ongkir;
                                    @endphp
                                @endforeach
                                <table class="table">
                                    <tr>
                                        <th>Sub Total</th>
                                        <th>:</th>
                                        <td>Rp.{{number_format($sub_total)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Ongkir</th>
                                        <th>:</th>
                                        <td id="hasil_ongkir">Rp.</td>
                                    </tr>
                                    <tr>
                                        <th>Total belanja</th>
                                        <th>:</th>
                                        <td id="total_belanja">Rp.</td>
                                        <input type="hidden" id="input_total_belanja">
                                    </tr>
                                </table>
                                <button type="button" id="pay-button" class="btn btn-block btn-primary my-3 py-3">Proses Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <form action="{{route('send.result.midtrans')}}" method="post" id="myForm">
            @csrf
            <input type="hidden" name="json" id="json">
            <input type="hidden" class="form_control" name="hasil_ongkir" id="hasil_ongkir1">
            <input type="hidden" class="form_control" name="courier" id="courier1">
        </form>

        <script>
            var id_user = {{Auth::guard('member')->user()->id}}
            $(document).ready(function(){
                //aktif kan select 2
                $(".provinsi-asal, .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
                    theme:'boostrap4',width:'style',
                });
                //ajax select kota asal
                $('select[name="province_origin"]').on('change', function(){
                    let provindeId = $(this).val();
                    if(provindeId){
                        jQuery.ajax({
                            url: '/cities/'+provindeId,
                            type: "GET",
                            dataType: "json",
                            success: function (response){
                                $('select[name="city_origin"]').empty();
                                $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                                $.each(response, function (key, value) {
                                    $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            },
                        });
                    }else{
                        $('select[name="city_origin"]').append('<option value="">--Pilih Kota Asal--</option>');
                    }
                });
                //ajax select kota tujuan
                $('select[name="province_destination"]').on('change',function(){
                    let provindeId = $(this).val();
                    if(provindeId){
                        jQuery.ajax({
                            url: '/cities/'+provindeId,
                            type: "GET",
                            dataType: "json",
                            success: function (response){
                                $('select[name="city_destination"]').empty();
                                $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                                $.each(response, function (key, value) {
                                    $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            },
                        });
                    }else{
                        $('select[name="city_destination"]').append('<option value="">--Pilih Kota Tujuan--</option>');
                    }
                });
                //ajax check ongkir
                let isProcessing = false;
                $('.btn-check').change(function (e){
                    e.preventDefault();

                    let token            = $("meta[name='csrf-token']").attr("content");
                    let city_origin      = $('select[name=city_origin]').val();
                    let city_destination = $('select[name=city_destination]').val();
                    let courier          = $('select[name=courier]').val();

                    if(courier == '0'){
                        $('#form-ongkir').html(' ');
                    }else{
                        if(isProcessing){
                            return;
                        }
                        isProcessing = true;
                        jQuery.ajax({
                            url: "cart/"+id_user,
                            data:{
                                _token:              token,
                                city_origin:         city_origin,
                                city_destination:    city_destination,
                                courier:             courier,
                            },
                            dataType: "JSON",
                            type: "POST",
                            success:function (response){
                                isProcessing = false;
                                if(response){
                                    $('#ongkir').empty();
                                    $('.ongkir').addClass('d-block');
                                    $.each(response[0]['costs'], function(key, value){
                                        // $('#ongkir').append('<li class="list-group-item">'+response[0].code.toUpperCase()
                                        // +' : <strong>'+value.service+'</strong> - Rp. '+value.cost[0].value
                                        // +' ('+value.cost[0].etd+' hari)</li>')


                                        $('#ongkir').append(`<input onclick="hasil_cost()" type="radio" name="cost" id="cost"
                                        value=${value.cost[0].value}-${value.service}> ${response[0].code.toUpperCase()} : <strong>
                                        ${value.service} </strong> - Rp. ${value.cost[0].value} (${value.cost[0].etd} Hari) <br>`);
                                    });
                                }
                            }
                        });
                    }

                });
            });
            function hasil_cost(){
                var cost = $('input[name="cost"]:checked').val();
                var pecah = cost.split("-");
                var sub_total = '{{$sub_total}}';
                var total = parseInt(cost) + parseInt(sub_total);
                    $('#hasil_ongkir').html(`Rp. ${cost}`);
                //    $('#courier').html(`${service}`);
                    $('#hasil_ongkir1').val(pecah[0]);
                    $('#total_belanja').html(`Rp. ${total}`);
                    $('#input_total_belanja').val(total);
                    $('#courier1').val(pecah[1]);
            }
        </script>

        <script type="text/javascript">
             // For example trigger on button clicked, or any time you need
             var payButton = document.getElementById('pay-button');
             payButton.addEventListener('click', function () {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                var total_belanja = $('#input_total_belanja').val();
                var id_user = '{{Auth::user()->id}}';
                if(total_belanja == ''){
                    alert('Harap memilih pergiriman terlebih dahulu');
                }
                else
                {
                    $.ajax({
                        type: "post",
                        url: "{{route('get.snaptoken')}}",
                        data : {
                            total_belanja : total_belanja,
                            id_user:id_user,
                        },
                        dataType : "json",
                        success: function (response) {
                            console.log(response)
                            if(response.status == 'ok'){
                                window.snap.pay(response.snaptoken, {
                                onSuccess: function(result){
                                    /* You may add your own implementation here */
                                    alert("payment success!"); console.log(result);
                                },
                                onPending: function(result){
                                    /* You may add your own implementation here */
                                    alert("wating your payment!");
                                    // alert(JSON.stringify(result));
                                    $('#json').val(JSON.stringify(result));
                                    $('#myForm').submit();

                                },
                                onError: function(result){
                                    /* You may add your own implementation here */
                                    alert("payment failed!"); console.log(result);
                                },
                                onClose: function(){
                                    /* You may add your own implementation here */
                                    alert('you closed the popup without finishing the payment');
                                }
                                })
                            }
                        }
                    });
                }
             });
        </script>
        <br>
@endsection
