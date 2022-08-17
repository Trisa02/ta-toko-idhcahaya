@extends('backend.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-8">
            <div class="col-sm-20 col-xl-10">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Barang Idh.Cahaya</h6>
                    <form class="row g-3" enctype="multipart/form-data" action="{{route('save-barang')}}" method="post">
                        @csrf
                        <div class="col-md-6">
                          <label for="nama_barang" class="form-label">Nama Barang</label>
                          <input type="text" class="form-control" name="nama_barang">
                        </div>
                        <div class="col-md-6">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <select id="nama_kategori" name="id_kategori" class="form-select">
                                <option selected>Pilih Kategori...</option>
                                @foreach ($kategori as $i => $isi)
                                    <option value="{{$isi->id_kategori}}">{{$isi->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="text" name="stok" class="form-control" id="stok">
                        </div>
                        <div class="col-md-4">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" id="harga">
                        </div>
                        <div class="col-md-2">
                            <label for="berat" class="form-label">Berat</label>
                            <input type="text" name="berat" class="form-control" id="berat">
                        </div>
                        <div class="col-12">
                          <label for="detail" class="form-label">Detail Barang</label>
                          <textarea class="form-control" name="detail" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Gambar</label>
                            <input type="file" name="gambar" class="form-control" placeholder="Gambar">
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Save Barang</button>
                        </div>

                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
