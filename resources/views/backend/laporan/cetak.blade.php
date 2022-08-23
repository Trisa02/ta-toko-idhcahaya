<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <img src="{{asset('gambar/logo.png')}}" alt="" style="width: 8em;position: absolute;margin-top:30px;margin-left:10px"> --}}
    <center>
        <font size="5"><b>Laporan Penjualan IDH.Cahaya</b></font><br>
        <font size="3"><b>Jl. Trans Sumatera Bukittinggi - Padang Sidempuan</b></font><br>
        <font size="3"><b>Ganggo Mudiak, Kec. Bonjol, Kabupaten Pasaman, Sumatera Barat</b></font><br>
        <font size="3"><b>Telp : +62 83193730772, Email : Idh.Cahaya@gmail.com</b></font>

    </center>
    <br>
    <table border="1" style="border-collapse: collapse; width: 100%">
        <thead>
            <tr class="text-dark text-center">
                <th scope="col">No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Nama Member</th>
                <th scope="col">Pengiriman</th>
                <th scope="col">Payment Type</th>
                <th scope="col">Transaction Status</th>
                <th scope="col">Transaction Time</th>
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
</body>
</html>
