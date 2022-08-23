@extends('backend.index')
@section('content')
    <style type="text/css">
        .pagination li{
            float: left;
            list-style-type: none;
            margin: 5px;
        }
    </style>
    <div class="container-fluid pt-4 ">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Transaksi Idh.Cahaya</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark text-center">
                            <th scope="col">No</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Nama Pembeli</th>
                            <th scope="col">Pengiriman</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Status Transaksi</th>
                            <th scope="col">Waktu Transaksi</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary">{{ $item->order_id }}</span></td>
                            <td>{{ $item->nama_member }}</td>

                            <td style="width: 30%">
                                <ul>Kurir : {{ $item->kurir }}</ul>
                                <ul>Ongkir : {{ number_format( $item->ongkir) }}</ul>
                                <ul>Total Bayar : {{ number_format($item->total_bayar) }}</ul>
                            </td>
                            <td>{{ $item->payment_type }}</td>
                            <td> <span class="badge bg-primary">{{ $item->transaction_status }}</span> </td>
                            <td>{{ date('d-m-Y H:i:s', strtotime( $item->transaction_time)) }}</td>
                            <td style="width: 20%">
                                @if ($item->transaction_status == 'settlement')
                                    @if ($item->nomor_resi == null)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->order_id }}">
                                        <i class="fa fa-edit"></i> input resi
                                      </button>
                                    @else
                                    <i class="text-primary">resi : {{ $item->nomor_resi }}</i>
                                    @endif
                                @endif
                                <br>
                                <a onclick="return confirm('yakin???')" href="{{ route('transaksi.delete', ['id' => $item->id_transaksi]) }}" class="btn btn-danger mt-2"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>

                         <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $item->order_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nomor Resi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 style="text-align: left">Invoice : {{ $item->order_id }}</h6>
                                    <h6 style="text-align: left">Nama Pembeli : {{ $item->nama_member }}</h6>
                                    <h6 style="text-align: left">Status Transaksi : <span class="badge bg-primary">{{ $item->transaction_status }}</span></h6>
                                    <hr>
                                    <form action="{{ route('transaksi.store_resi') }}" method="POST">
                                        <input type="hidden" name="order_id" value="{{ $item->order_id }}">
                                        @csrf
                                        <div class="form-group">
                                            <h6>Input Nomor Resi</h6>
                                            <input type="text" name="nomor_resi" id="" class="form-control">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



@endsection
