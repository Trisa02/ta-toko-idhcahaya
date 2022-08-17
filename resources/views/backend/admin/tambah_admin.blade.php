@extends('backend.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Kategori Barang</h6>
                    <form action="{{route('save-admin')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama_admin" class="col-sm-4 col-form-label">Nama Admin</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_admin" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="">Gambar</label>
                            <div class="col-sm-10">
                            <input type="file" name="gambar" class="form-control" placeholder="Gambar">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block ">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
