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

class BeliLangsungController extends Controller
{
    public function viewbelilangsung(Request $r)
    {
        $id = Auth::user()->id;
        $data['beli'] = DB::table('belilangsungs')
            ->join('barangs', 'belilangsungs.id_barang', '=', 'barangs.id_barang')
            ->where('id', $id)->get();
        $data['jumlah'] = DB::table('keranjangs')->where('id', session('id'))->count();
        $data['member'] = DB::table('members')->where('id', $id)->first();
        return view('frontend.transaksi.view_belilangsung', $data);
    }

    public function belilangsung(Request $r)
    {
        // dd($r->all());
        $validator = Validator::make($r->all(), [
            'id_barang' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('view_belilangsung')
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = Auth::user()->id;
            $barang = DB::table('barangs')->where('id_barang', $r->id_barang)->first();
            $harga = $barang->harga;
            $total = $harga * $r->qty;

            if ($barang->stok < $r->qty) {
                $pesan = "Stok $barang->nama_barang Tidak Cukup, Stok Saat ini : $barang->stok";
                return redirect()->back()->with('pesan', $pesan);
            }

            $cek = DB::table('belilangsungs')->where('id_barang', $r->id_barang)
                ->where('id', $id)->first();
            if ($cek != null) {
                $simpan = DB::table('belilangsungs')->where('id_beli', $cek->id_beli)->update([
                    'qty' => $cek->qty + $r->qty,
                    'total' => $cek->total + $harga,
                ]);
            } else {
                $simpan = DB::table('belilangsungs')->insert([
                    'id' => $id,
                    'id_barang' => $r->id_barang,
                    'tanggal' => date('Y-m-d'),
                    'qty' => $r->qty,
                    'total' => $total,
                ]);
            }
        }
        if ($simpan == TRUE) {
            return redirect('view-belilangsung')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('index-frontend')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function check_ongkir(Request $request, $id_user)
    {
        $berat = DB::table('belilangsungs')->where('id', $id_user)->get();
        $totalbarek = 0;
        foreach ($berat as $br) {
            $barek = DB::table('barangs')->where('id_barang', $br->id_barang)->first();
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
