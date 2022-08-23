@extends('backend.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Tabel Data Admin Idh.Cahaya</h6>
                <a href="{{route('tambah-admin')}}">Tambah Admin</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Admin</th>
                            <th scope="col">Username</th>
                            <th scope="col">Level</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataadmin as $i => $isi)
                            <tr>
                                <td>{{$i +1}}</td>
                                <td>{{$isi->nama_admin}}</td>
                                <td>{{$isi->username}}</td>
                                <td>{{$isi->level_user}}</td>
                                <td><img src="{{asset('gambar/'. $isi->gambar)}}" width="20%" alt=""></td>
                                <td><a href="{{route('edit-admin',$isi->id_admin)}}" class=" btn btn-warning btn-block "><i class="fa fa-edit"></i></a>
                                    <br>
                                    <a href="{{route('hapus-admin',$isi->id_admin)}}" class=" btn btn-danger  btn-block "><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        toastr.success('Data Berhasil Ditambahkan');
    </script>
@endsection
