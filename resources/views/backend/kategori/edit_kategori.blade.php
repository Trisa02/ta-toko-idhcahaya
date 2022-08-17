@extends('backend.index')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah Kategori Barang</h6>
                <form action="{{route('save-edit-kategori')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <input type="hidden" name="id_kategori" value="{{$kategori->id_kategori}}" class="form-control">
                    </div>
                    <div class="row mb-3">
                        <label for="nama_kategori" class="col-sm-4 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text"  name="nama_kategori" value="{{$kategori->nama_kategori}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block ">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
