@extends('backend.index')
@section('content')
    <style type="text/css">
        .pagination li{
            float: left;
            list-style-type: none;
            margin: 5px;
        }
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Kategori Idh.Cahaya</h6>
                <a href="{{route('tambah-kategori')}}">Tambah Kategori</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Kategori Barang</th>
                            <th scope="col">Slug Kategori Barang</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $i => $isi)
                            <tr>
                                <td>{{$i +1}}</td>
                                <td>{{$isi->nama_kategori}}</td>
                                <td>{{$isi->slug_kategori}}</td>
                                <td><a href="{{route('edit-kategori',$isi->id_kategori)}}" class=" btn btn-warning btn-block "><i class="fa fa-edit"></i></a>
                                    <a href="{{route('hapus-kategori',$isi->id_kategori)}}" class=" btn btn-danger  btn-block "><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$kategori->links()}}
            </div>
        </div>
    </div>
@endsection
