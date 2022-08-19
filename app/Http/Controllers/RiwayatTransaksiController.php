<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiController extends Controller
{
    public function view_riwayat_transaksi(){
        $id = Auth::user()->id;
        // dd($id);
        // $data
        $transaksi = DB::table('transaksis')->where('id',$id)->get();
        $riwayat=[];
        foreach($transaksi as $key => $val){
            $riwayat[$val->order_id] = [
                'invoice' => $val->order_id,
                'total_bayar'=>$val->total_bayar,
                'status' => $val->transaction_status,
                'data' =>  DB::table('penjualans')
                ->join('barangs','penjualans.id_barang','=','barangs.id_barang')
                ->where('invoice', $val->order_id)->get(),
            ];
        }
        // $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        // $data['barangs'] =DB::table('barangs')->get();
        // $transaksi['penjualan'] = DB::table('penjualans')
        //         ->join('barangs','penjualans.id_barang','=','barangs.id_barang')
        //         ->where('invoice', $val->order_id)->get();
        // dd($transaksi);
        return view ('Frontend.Transaksi.view_riwayat_transaksi',compact('riwayat'));
    }

    public function detail_riwayat_transaksi(){
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        return view ('Frontend.Transaksi.detail_riwayat_transaksi',$data);
    }

}
