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
            <h6 class="mb-0">Filter Data</h6>
        </div>
        <form action="" method="POST">
        <div class="row">
                @csrf
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Pilih Bulan <i class="text-danger"><small>( boleh di kosongkan )</small> </i></label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-select-</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    @if (isset($_POST['lihat']))
                        <script>
                            document.getElementById('bulan').value = "{{ $_POST['bulan'] }}"
                        </script>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Pilih Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            @php
                                $y = 2020;
                            @endphp
                            @for ($i = $y; $i <date('Y') + 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    @if (isset($_POST['lihat']))
                    <script>
                        document.getElementById('tahun').value = "{{ $_POST['tahun'] }}"
                    </script>
                @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Pilih Status Transaksi <i class="text-danger"><small>( boleh di kosongkan )</small></i></label>
                        <select name="status" id="status" class="form-control">
                            <option value="">-select-</option>
                            <option value="pending">Belum Melakukan Pembayaran</option>
                            <option value="settlement">Sudah Melakukan Pembayaran</option>
                        </select>
                    </div>
                    @if (isset($_POST['lihat']))
                        <script>
                            document.getElementById('status').value = "{{ $_POST['status'] }}"
                        </script>
                    @endif
                </div>
                <div class="col-md-4">
                    <br>
                    <div class="d-grid gap-2">
                    <button type="submit" name="lihat" class="btn btn-primary">Lihat Data</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if (isset($_POST['lihat']))
@php
function convertBulan($b){
    if($b == '01'){
        return 'Januari';
    }else if($b == '02'){
        return 'Februari';
    }else if($b == '03'){
        return 'Maret';
    }else if($b == '04'){
        return 'April';
    }else if($b == '05'){
        return 'Mei';
    }else if($b == '06'){
        return 'Juni';
    }else if($b == '07'){
        return 'Juli';
    }else if($b == '08'){
        return 'Agustus';
    }else if($b == '09'){
        return 'September';
    }else if($b == '10'){
        return 'Oktober';
    }else if($b == '11'){
        return 'November';
    }else if($b == '12'){
        return 'Desember';
    }
}
if($_POST['bulan'] != '' && $_POST['status'] != ''){
    $transaction = DB::table('transaksis')
    ->join('members', 'transaksis.id', '=', 'members.id')
    ->whereMonth('transaction_time', $_POST['bulan'])
    ->whereYear('transaction_time', $_POST['tahun'])
    ->where('transaction_status', $_POST['status'])
    ->orderBy('transaction_time', 'DESC')->get();
}else{
    $transaction = DB::table('transaksis')
    ->join('members', 'transaksis.id', '=', 'members.id')
    ->whereYear('transaction_time', $_POST['tahun'])
    ->orderBy('transaction_time', 'DESC')->get();
}

@endphp
<div class="container-fluid pt-4 ">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Transaksi Idh.Cahaya ( {{ $_POST['bulan'] != '' ? 'Bulan '.convertBulan($_POST['bulan']) : '' }} Tahun {{ $_POST['tahun'] }} )</h6>
            <form target="_blank" action="{{ route('laporan.cetak') }}" method="POST">
                @csrf
                <input type="hidden" name="bulan" value="{{ $_POST['bulan'] }}">
                <input type="hidden" name="tahun" value="{{ $_POST['tahun'] }}">
                <input type="hidden" name="status" value="{{ $_POST['status'] }}">
                <button type="submit" class="btn btn-success">Cetak Laporan</button>
            </form>
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
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endif



@endsection
