@extends('backend.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            @if (session('level_user') == 'admin')
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user me-2 fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Admin</p>
                        {{-- <h6 class="mb-0">$1234</h6> --}}
                    </div>
                </div>
            </div>
            @endif
            @if (session('level_user') == 'karyawan' || session('level_user') == 'admin')
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-th me-2 fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Kategori Barang</p>
                        {{-- <h6 class="mb-0">$1234</h6> --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-laptop me-2 fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Barang</p>
                        {{-- <h6 class="mb-0">$1234</h6> --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-cart-plus me-2 fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Transaksi</p>
                        {{-- <h6 class="mb-0">$1234</h6> --}}
                    </div>
                </div>
            </div>
            @endif
            @if (session('level_user') == 'admin')
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="far fa-file-alt  fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Laporan Penjualan</p>
                        {{-- <h6 class="mb-0">$1234</h6> --}}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
