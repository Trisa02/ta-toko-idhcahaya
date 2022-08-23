<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KategoriAdminController extends Controller
{
    public function viewkategori(){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['kategori']= DB::table('kategoris')->simplePaginate(10);
        return view('backend.kategori.view_kategori',$data);
    }

    public function tambahkategori(){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        return view('backend.kategori.tambah_kategori',$data);
    }

    public function savekategori(Request $r){
        $validator = Validator::make($r->all(),[
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ],
        [
            'nama_kategori.unique' => 'Nama Kategori Sudah Ada',
        ]);

        if($validator->fails()){
            return redirect()->route('tambah-kategori')
                ->withErrors($validator)
                ->withInput();
        }

        $simpan = Kategori::insert([
            'nama_kategori' => $r->nama_kategori,
            'slug_kategori' => Str::slug($r->nama_kategori),

        ]);

        if ($simpan == TRUE) {
            return redirect()->route('view-kategori')->with('success','Data berhasil disimpan');
        }else{
            return redirect()->route('tambah-kategori')->with('error','Data gagal disimpan');
        }
    }

    public function editkategori($id){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['kategori']=DB::table('kategoris')->where('id_kategori', $id)->first();
        return view ('backend.kategori.edit_kategori',$data);
    }

    public function save_editkategori(Request $request){
        $id=$request->id_kategori;
        $validator = Validator::make($request->all(),[
            'nama_kategori'=>'required',
        ]);

        if($validator->fails()){
            return redirect('tambah-kategori')
                ->withErrors($validator)
                ->withInput();
        }

        $update = Kategori::where('id_kategori',$id)->update([
            'nama_kategori'=>$request->nama_kategori,
            'slug_kategori'=>Str::slug($request->nama_kategori),
        ]);

        if ($update == TRUE) {
            return redirect()->route('view-kategori')->with('success','Data berhasil disimpan');
        }else{
            return redirect()->route('edit-kategori')->with('error','Data gagal disimpan');
        }
    }

    public function hapuskategori($id){
        $hapus = DB::table('kategoris')->where('id_kategori', $id)->delete();
        if ($hapus == TRUE) {
            return redirect()->route('view-kategori')->with('success','Data berhasil dihapus');
        }else{
            return redirect()->route('view-kategori')->with('error','Data gagal dihapus');
        }
    }
}
