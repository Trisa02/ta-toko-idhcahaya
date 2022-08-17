<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BarangAdminController extends Controller
{
    public function indexbarang(){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['barang'] = DB::table('barangs')
        ->join('kategoris','barangs.id_kategori','=','kategoris.id_kategori')
        ->simplePaginate(10);
        return view ('backend.barang.viewbarang',$data);
    }

    public function tambahbarang(){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['kategori']= DB::table('kategoris')->get();
        return view ('backend.barang.tambah_barang',$data);
    }

    public function simpanbarang(Request $r){
        $Validator = Validator::make($r->all(),[
            'nama_barang'=>'required',
            'id_kategori' => 'required',
            'stok'=>'required',
            'harga'=>'required',
            'berat'=>'required',
            'detail'=>'required',
            'gambar'=>'required'
        ]);

        if($Validator->fails()){
            return redirect()->route('tambah-barang')
                ->withErrors($validator)
                ->withInput();
        }
        $file = $r->file('gambar');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file->move('gambar/',$fileName);

        $simpan = Barang::insert([
            'nama_barang'=>$r->nama_barang,
            'id_kategori'=>$r->id_kategori,
            'stok'=>$r->stok,
            'harga'=>$r->harga,
            'berat'=>$r->berat,
            'slug_barang' => Str::slug($r->nama_barang),
            'detail'=>$r->detail,
            'gambar'=>$fileName,
        ]);
        if ($simpan == TRUE) {
            return redirect()->route('view-barang')->with('success','Data berhasil disimpan');
        }else{
            return redirect()->route('tambah-barang')->with('error','Data gagal disimpan');
        }
    }

    public function editbarang($id_barang){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['barang']=DB::table('barangs')->where('id_barang',$id_barang)->first();
        $data['kategori']= DB::table('kategoris')->get();
        return view('backend.barang.edit_barang',$data);
    }

    public function save_editbarang(Request $r){
        $id=$r->id_barang;
        $Validator = Validator::make($r->all(),[
            'nama_barang'=>'required',
            'id_kategori' => 'required',
            'stok'=>'required',
            'harga'=>'required',
            'berat'=>'required',
            'detail'=>'required',
        ]);
        if($Validator->fails()){
            return redirect()->route('tambah-barang')
                ->withErrors($Validator)
                ->withInput();
        }
        if($r->file('gambar') == Null){
            $update = Barang::where('id_barang',$id)->update([
                'nama_barang'=>$r->nama_barang,
                'id_kategori'=>$r->id_kategori,
                'stok'=>$r->stok,
                'harga'=>$r->harga,
                'berat'=>$r->berat,
                'slug_barang' => Str::slug($r->nama_barang),
                'detail'=>$r->detail,
            ]);
        }
        else{
            $fotolama= DB::table('barangs')->where('id_barang', $id)->first();
            //dd($fotolama);
            if ($fotolama->gambar != NULL) {
                unlink('gambar/'. $fotolama->gambar);
            }
            $file = $r->file('gambar');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file->move('gambar/',$fileName);

            $update = Barang::where('id_barang',$id)->update([
                'nama_barang'=>$r->nama_barang,
                'id_kategori'=>$r->id_kategori,
                'stok'=>$r->stok,
                'harga'=>$r->harga,
                'berat'=>$r->berat,
                'slug_barang' => Str::slug($r->nama_barang),
                'detail'=>$r->detail,
                'gambar'=>$fileName,
            ]);
        }
        if ($update == TRUE) {
            return redirect()->route('view-barang')->with('success','Data berhasil disimpan');
        }else{
            return redirect()->route('edit-barang')->with('error','Data gagal disimpan');
        }
    }

    public function hapusbarang($id){
        $hapus = DB::table('barangs')->where('id_barang', $id)->delete();
        if ($hapus == TRUE) {
            return redirect()->route('view-barang')->with('success','Data berhasil dihapus');
        }else{
            return redirect()->route('view-barang')->with('error','Data gagal dihapus');
        }
    }
}
