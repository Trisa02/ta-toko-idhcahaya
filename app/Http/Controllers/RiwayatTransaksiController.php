<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        return view ('Frontend.Transaksi.view_riwayat_transaksi',compact('riwayat'));
    }

    public function detail_riwayat_transaksi($invoice){
        $id = Auth::user()->id;

        $data['member'] = DB::table('members')->where('id',$id)->first();

        $data['transaksi'] = DB::table('transaksis')->where('order_id',$invoice)->first();

        $data['kota'] =DB::table('cities')->where('city_id', Auth::user()->city_destination)->first();

        $data['detail'] = DB::table('penjualans')
        ->join('members','penjualans.id', '=', 'members.id')
        ->join('barangs','penjualans.id_barang', '=', 'barangs.id_barang')
        ->where('invoice',$invoice)->get();

        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        // dd($data);
        return view ('Frontend.Transaksi.detail_riwayat_transaksi',$data);
    }

    public function lacak(Request $request){
        $api_key = '24c23afb1a9d3f17818f27910bc9d1416704813098f04a0b744aa01d03f28d8e';

        $invoice = $request->invoice;
        $transaksi = DB::table('transaksis')->where('order_id', $invoice)->first();
        // dd($transaksi);

        $response = Http::get('https://api.binderbyte.com/v1/track',[
            'api_key' => $api_key,
            'courier' => $transaksi->kurir,
            'awb' => $transaksi->nomor_resi,
        ]);

        $response = $response->json();
        // dd($response);

        $data = [
            'status' => 'ok',
            'summary' => $response['data']['summary'],
            'history' => $response['data']['history'],
        ];

        return response()->json($data);
    }

}
