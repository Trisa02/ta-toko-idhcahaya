@extends('frontend.template')
@section('content')
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Akun Saya</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('edit-akun',$akun->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="checkout__order">
                            <h4>Profil Saya</h4>
                            <div class="checkout__input">
                                <img src="{{asset('gambar/'.$akun->gambar)}}" width="30%" height="30%" class="rounded-circle" alt="Cinque Terre">
                                <input type="file" name="gambar" >
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nama Lengkap</p>
                                        <input type="text" class="text-dark" value="{{$akun->nama_member}}" name="nama_member">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Username</p>
                                        <input type="text" class="text-dark" value="{{$akun->username_member}}" name="username_member">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Email</p>
                                <input type="text" class="text-dark" value="{{$akun->email_member}}" name="email_member">
                            </div>
                            <div class="checkout__input">
                                <p>No Telepon</p>
                                <input type="text" class="text-dark" value="{{$akun->no_telepon}}" name="no_telepon">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <p>Provinsi</p>
                                        <select class="form-control provinsi-tujuan" name="province_destination" style="width: 90%">
                                            @foreach ($provinces as $province =>$value)
                                                <option value="{{$province}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <p>Kota/Kabupaten</p>
                                        <select class="form-control kota-tujuan" name="city_destination" style="width: 90%">
                                            <option value="">-- Pilih Kota --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Alamat Lengkap</p>
                                <textarea cols="100" rows="5" name="alamat_member">{{$akun->alamat_member}}</textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" style="height:50px;width:150px" class="btn btn-success btn-md">Simpan Akun</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
    <script>
    $(document).ready(function(){
     //active select2
     $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
         theme:'bootstrap4',width:'style',
     });
     //ajax select kota tujuan
     $('select[name="province_destination"]').on('change', function () {
         let provindeId = $(this).val();
         if (provindeId) {
             jQuery.ajax({
                 url: '/cities-akun/'+provindeId,
                 type: "GET",
                 dataType: "json",
                 success: function (response) {
                     $('select[name="city_destination"]').empty();
                     $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                     $.each(response, function (key, value) {
                         $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                     });
                 },
             });
         } else {
             $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
         }
     });
     //ajax check ongkir
    });
 </script>
@endsection
