@extends('backend.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Profil Admin</h6>
                        <a href="{{route('tambah-admin')}}">Tambah Admin</a>
                    </div>
                    <form>
                        <div class="form-group">
                            <img src="{{asset('gambar/'.$admin->gambar)}}" width="30%" height="30%" class="rounded-circle" alt="Cinque Terre">
                        </div>
                        <div class="row mb-3">
                            <label for="nama admin" class="col-sm-4 col-form-label">Nama Admin</label>
                            <div class="col-sm-8">
                                <label for="inputEmail3" class="col-sm-6 col-form-label">{{$admin->nama_admin}}</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <label for="username" class="col-sm-6 col-form-label">{{$admin->username}}</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <label for="username" class="col-sm-6 col-form-label">{{$admin->level_user}}</label>
                            </div>
                        </div>
                        <a href="{{route('edit-admin',$admin->id_admin)}}"  class="btn btn-primary">Edit Data</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
