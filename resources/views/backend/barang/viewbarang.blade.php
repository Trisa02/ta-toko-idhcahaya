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
                <h6 class="mb-0">Data Produk Idh.Cahaya</h6>
                <a href="{{route('tambah-barang')}}">Tambah Produk</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Stok</th>
                            <th scope="col">harga</th>
                            <th scope="col">berat</th>
                            <th scope="col">Detail</th>
                            <th scope="col">slug</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $i => $isi)
                            <tr>
                                <td>{{$i +1}}</td>
                                <td>{{$isi->nama_barang}}</td>
                                <td>{{$isi->nama_kategori}}</td>
                                <td>{{$isi->stok}}</td>
                                <td>{{$isi->harga}}</td>
                                <td>{{$isi->berat}}</td>
                                <td>{{$isi->detail}}</td>
                                <td>{{$isi->slug_barang}}</td>
                                <td><img src="{{asset('gambar/'. $isi->gambar)}}" width="100%" alt=""></td>
                                <td><a href="{{route('edit-barang',$isi->id_barang)}}" class=" btn btn-warning btn-block "><i class="fa fa-edit"></i></a>
                                    <a href="{{route('hapus-barang',$isi->id_barang)}}" class=" btn btn-danger  btn-block "><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br/>
                {{$barang->links()}}
            </div>
        </div>
    </div>
@endsection
