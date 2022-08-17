<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiController extends Controller
{
    public function view_riwayat_transaksi(){
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        $data['barangs'] =DB::table('barangs')->get();
        return view ('Frontend.Transaksi.view_riwayat_transaksi',$data);
    }

    public function detail_riwayat_transaksi(){
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        return view ('Frontend.Transaksi.detail_riwayat_transaksi',$data);
    }
}
