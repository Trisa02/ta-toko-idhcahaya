<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function view_chechkout(Request $r){
        $id = Auth::user()->id;
        $data['checkout'] = DB::table('keranjangs')
        ->join('barangs','keranjangs.id_barang','=','barangs.id_barang')
        ->where('id',$id)->get();
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        $data['member']=DB::table('members')->where('id',$id)->first();
        // dd($data);
        return view ('frontend.transaksi.view_checkout',$data);
    }

    public function viewbelilangsung(Request $r){
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        return view ('frontend.transaksi.view_belilangsung',$data);
    }



    public function getCities($id){
        $city = City::where('province_id',$id)->pluck('name','city_id');
        return response()->json($city);
    }

    public function check_ongkir(Request $request,$id_user){
        $berat=DB::table('keranjangs')->where('id',$id_user)->get();
        $totalbarek = 0;
        foreach($berat as $br){
            $barek = DB::table('barangs')->where('id_barang',$br->id_barang)->first();
            $totalbarek += $barek->berat;
        }
        $cost = RajaOngkir::ongkoskirim([
            'origin'        => $request->city_origin,
            'destination'   => $request->city_destination,
            'weight'        => $totalbarek,
            'courier'       => $request->courier
        ])->get();
        return response()->json($cost);
    }
}
