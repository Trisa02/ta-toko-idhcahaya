<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function viewkeranjang()
    {
        if (Auth::user() != null) {
            $id = Auth::user()->id;
            $data['kategori'] = DB::table('kategoris')->get();
            $data['keranjang'] = DB::table('keranjangs')
                ->join('barangs', 'keranjangs.id_barang', '=', 'barangs.id_barang')
                ->where('id', $id)->get();
            $data['jumlah'] = DB::table('keranjangs')->where('id', session('id'))->count();
            // dd($data);
            return view('frontend.keranjang.view_keranjang', $data);
        } else {
            return redirect('login-member');
        }
    }

    public function tambahkeranjang(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_barang' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('view_keranjang')
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = Auth::user()->id;
            $barang = DB::table('barangs')->where('id_barang', $r->id_barang)->first();
            $harga = $barang->harga;
            $total = $harga * $r->qty;
            // dd($barang);

            $cek = DB::table('keranjangs')->where('id_barang', $r->id_barang)
                ->where('id', $id)->first();
            if ($cek == TRUE) {
                $simpan = DB::table('keranjangs')->where('id_keranjang', $cek->id_keranjang)->update([
                    'qty' => $cek->qty + 1,
                    'total' => $cek->total + $harga,
                ]);
            } else {
                $simpan = DB::table('keranjangs')->insert([
                    'id' => $id,
                    'id_barang' => $r->id_barang,
                    'tanggal' => date('Y-m-d'),
                    'qty' => $r->qty,
                    'total' => $total,
                ]);
            }
        }
        if ($simpan == TRUE) {
            return redirect('view-keranjang')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('index-frontend')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function hapus($id)
    {
        $hapus = DB::table('keranjangs')->where('id_keranjang', $id)->delete();
        if ($hapus == TRUE) {
            return redirect('view-keranjang')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect('view-keranjang')->with('error', 'Data Gagal Dihapus');
        }
    }

    public function qtytambah($id_keranjang, $id_barang)
    {
        $id = Auth::user()->id;
        $keranjang = DB::table('keranjangs')
            ->join('barangs', 'keranjangs.id_barang', '=', 'barangs.id_barang')
            ->where('id_keranjang', $id_keranjang)->first();

        $qty = $keranjang->qty;
        $total = $qty + 1;

        $harga = $keranjang->harga;
        $ttl = $total * $harga;

        $update = DB::table('keranjangs')
            ->where('id_keranjang', $id_keranjang)
            ->update(['qty' => $total, 'total' => $ttl]);

        return back();
    }

    public function qtykurang($id_keranjang, $id_barang)
    {
        $id = Auth::user()->id;
        $keranjang = DB::table('keranjangs')
            ->join('barangs', 'keranjangs.id_barang', '=', 'barangs.id_barang')
            ->where('id_keranjang', $id_keranjang)->first();

        $qty = $keranjang->qty;
        $total = $qty - 1;

        if ($total <= 0) {
            DB::table('keranjangs')->where('id_keranjang', $id_keranjang)->delete();
        } else {
            $harga = $keranjang->harga;
            $ttl = $total * $harga;

            $update = DB::table('keranjangs')->where('id_keranjang', $id_keranjang)
                ->update(['qty' => $total, 'total' => $ttl]);
        }
        return back();
    }
}
