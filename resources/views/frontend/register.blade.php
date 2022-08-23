<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <title>Register Akun</title>
  </head>
  <body style="background-image: url('{{asset('/')}}logincss/images/toko2.png');">
        <div class="container" >
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h3 class="text-center">Register</h3>
                            {{--menampilkan  error validasi--}}
                            <br/>
                            <!-- form validasi -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{route('simpan-register')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_user">Nama Member</label>
                                            <input class="form-control" type="text" name="nama_member" placeholder="Input Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input class="form-control" type="text" name="username_member" placeholder="Input Username" >
                                        </div>
                                        <div class="form-group">
                                            <label for="password_user">Password</label>
                                            <input class="form-control" type="password" name="password" placeholder="Input Password" >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Alamat Email</label>
                                            <input class="form-control" type="text" name="email_member" placeholder="Input Email" >
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon">No Telepon</label>
                                            <input class="form-control" type="text" name="no_telepon" placeholder="Input No Telepon" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Provinsi </label>
                                            <select class="form-control provinsi-tujuan" name="province_destination">
                                                <option value="0">-- Pilih Provinsi --</option>
                                                @foreach ($provinces as $province =>$value)
                                                    <option value="{{$province}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kota / Kabupaten</label>
                                            <select class="form-control kota-tujuan" name="city_destination">
                                                <option value="">-- Pilih Kota --</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon">Alamat Lengkap</label>
                                            <textarea class="form-control" type="text" name="alamat_member" placeholder="Input No Telepon" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input name="gambar" type="file" >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        url: '/cities-register/'+provindeId,
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


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>
