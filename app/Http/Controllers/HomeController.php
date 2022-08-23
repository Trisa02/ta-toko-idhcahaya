<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Barang;

class HomeController extends Controller
{
    public function index_frontend(Request $request){
        if($request->tnama == 'nama_barang'){
            $data['barang'] = DB::table('barangs')->where('nama_barang','like','%'.$request->tnama.'%')->get();
        }
        // elseif($request->tnama != 'nama_barang'){
        //     echo '<script>
        //             alert("Barang tidak ditemukan")
        //             window.location = "index-frontend"
        //         </script>';
        // }
        else{
            $data['barang'] = DB::table('barangs')->get();
        }
        $data['kategori'] = DB::table('kategoris')->get();
        $data['tampil_kategori'] = DB::table('kategoris')->get();
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        return view ('frontend.home',$data);
    }

    // public function cari(Request $request){
    //     $tnama = $request->tnama;
    //     $data['cekNama'] = DB::table('barangs')->where('nama_barang','like',"%".$tnama."%")->get();
    //     return view('produk.cariproduk',$data);
    // }

    public function detail_produk($slug_barang){
        $data['barang'] = DB::table('barangs')->get();
        $data['detail'] = DB::table('barangs')->where('slug_barang',$slug_barang)->get();
        return view ('frontend.produk.detail_barang',$data);
    }

    public function detail_perkategori($slug_kategori){
        $data['kategori'] = DB::table('kategoris')->get();
        $data['detail_kategori'] = DB::table('kategoris')->join('barangs','kategoris.id_kategori','=','barangs.id_kategori')
        ->where('kategoris.slug_kategori',$slug_kategori)->get();
        return view('frontend.produk.produk_perkategori',$data);
    }

}
