<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function get_snap_token(Request $request){
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-JHaJcvub_uXNh50dn4rZAI3c';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $user = DB::table('members')->where('id',$request->id_user)->first();
        $invoice = 'INV'.time();

        $keranjang = DB::table('keranjangs')->where('id',$request->id_user)->get();
        foreach($keranjang as $k => $val){
            DB::table('penjualans')->insert([
                'id' => $request->id_user,
                'invoice' => $invoice,
                'id_barang' => $val->id_barang,
                'qty' => $val->qty,
                'total' => $val->total,
                'tanggal' => $val->tanggal,
            ]);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $invoice,
                'gross_amount' => $request->total_belanja,
            ),
            'customer_details' => array(
                'first_name' => $user->nama_member,
                'email' => $user->email_member,
                'phone' => $user->no_telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data = [
            'status' => 'ok',
            'snaptoken' => $snapToken,
        ];
        return response()->json($data);
    }

    public function get_snap_token_langsung(Request $request){
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-JHaJcvub_uXNh50dn4rZAI3c';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $user = DB::table('members')->where('id',$request->id_user)->first();
        $invoice = 'INV'.time();

        $keranjang = DB::table('belilangsungs')->where('id',$request->id_user)->get();
        foreach($keranjang as $k => $val){
            DB::table('penjualans')->insert([
                'id' => $request->id_user,
                'invoice' => $invoice,
                'id_barang' => $val->id_barang,
                'qty' => $val->qty,
                'total' => $val->total,
                'tanggal' => $val->tanggal,
            ]);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $invoice,
                'gross_amount' => $request->total_belanja,
            ),
            'customer_details' => array(
                'first_name' => $user->nama_member,
                'email' => $user->email_member,
                'phone' => $user->no_telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data = [
            'status' => 'ok',
            'snaptoken' => $snapToken,
        ];
        return response()->json($data);
    }

    public function send_result_midtrans(Request $request)
    {
        $id = Auth::user()->id;
        $city = DB::table('cities')->where('city_id', Auth::user()->city_destination)->first();
        $tujuan = $city->name;
        $member = DB::table('members')->where('id',$id)->first();
        $alamat = $member->alamat_member;
        $json = json_decode($request->json);
        $asal = "Pasaman";

        $simpan = DB::table('transaksis')->insert([
            'id'=>$id,
            'total_bayar'=>$json->gross_amount,
            'asal'=>$asal,
            'tujuan'=>$tujuan,
            'alamat_pembeli'=>$alamat,
            'kurir'=>$request->courier,
            'ongkir'=>$request->hasil_ongkir,
            'order_id' => $json->order_id,
            'status_code' => $json->status_code,
            'status_message' => $json->status_message,
            'transaction_id' => $json->transaction_id,
            'payment_type' => $json->payment_type,
            'transaction_time' => $json->transaction_time,
            'transaction_status'=>$json->transaction_status,
        ]);

        if($simpan==TRUE){
            return redirect()->route('transaksi-selesai', ['invoice' => $json->order_id])->with('Success','Permintaan Anda sedang di proses');
        }else{
            return redirect('checkout-barang')->with('Error','Permintaan Gagal');
        }
    }

    public function send_result_midtrans_langsung(Request $request){
        $id = Auth::user()->id;
        $city = DB::table('cities')->where('city_id', Auth::user()->city_destination)->first();
        $tujuan = $city->name;
        $member = DB::table('members')->where('id',$id)->first();
        $alamat = $member->alamat_member;
        $json = json_decode($request->json);
        $asal = "Pasaman";

        $simpan = DB::table('transaksis')->insert([
            'id'=>$id,
            'total_bayar'=>$json->gross_amount,
            'asal'=>$asal,
            'tujuan'=>$tujuan,
            'alamat_pembeli'=>$alamat,
            'kurir'=>$request->courier,
            'ongkir'=>$request->hasil_ongkir,
            'order_id' => $json->order_id,
            'status_code' => $json->status_code,
            'status_message' => $json->status_message,
            'transaction_id' => $json->transaction_id,
            'payment_type' => $json->payment_type,
            'transaction_time' => $json->transaction_time,
            'transaction_status'=>$json->transaction_status,
        ]);

        if($simpan==TRUE){
            return redirect()->route('transaksi-selesai', ['invoice' => $json->order_id])->with('Success','Permintaan Anda sedang di proses');
        }else{
            return redirect('checkout-barang')->with('Error','Permintaan Gagal');
        }
    }

    public function detail_transaksi($invoice){
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        $id = Auth::user()->id;
        // dd(Auth::id());
        $data['selesai']=DB::table('transaksis')->where('order_id', $invoice)->first();

        $data['keranjang'] = DB::table('penjualans')
        ->join('members', 'penjualans.id', '=', 'members.id')
        ->join('barangs', 'penjualans.id_barang', '=', 'barangs.id_barang')
        ->where('invoice', $invoice)
        ->get();

        $data['user']=DB::table('members')->where('id',$id)->first();

        $data['kota'] = DB::table('cities')->where('city_id', Auth::user()->city_destination)->first();

        return view ('frontend.Transaksi.view_transaksi',$data);
    }
}
