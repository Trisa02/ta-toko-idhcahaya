<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function viewadmin(){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['dataadmin'] = DB::table('admins')->get();
        return view ('backend.admin.view_admin',$data);
    }

    public function tambahadmin(){
        $admin['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        return view('backend.admin.tambah_admin',$admin);
    }

    public function saveadmin(Request $r){
        $Validator = Validator :: make($r->all(),[
            'nama_admin'=>'required',
            'username'=>'required',
            'password'=>'required',
            'gambar'=>'required',
        ]);
        if($Validator->fails()){
            return redirect()->route('tambah-admin')
                ->withErrors($Validator)
                ->withInput();
        }
        $file = $r->file('gambar');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file->move('gambar/',$fileName);

        $simpan = Admin::insert([
            'nama_admin'=>$r->nama_admin,
            'username'=>$r->username,
            'password' => Hash::make($r->password),
            'gambar'=> $fileName,
        ]);
        if ($simpan == TRUE) {
            return redirect()->route('view-admin')->with('success','Data berhasil disimpan');
        }else{
            return redirect()->route('tambah-admin')->with('error','Data gagal disimpan');
        }
    }

    public function editadmin($id){
        $data['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        $data['admin']=DB::table('admins')->where('id_admin',$id)->first();
        return view('backend.admin.edit_admin',$data);
    }

    public function save_editadmin(Request $r){
        $id=$r->id_admin;
        $Validator = Validator::make($r->all(),[
            'nama_admin'=>'required',
            'username'=>'required',
            'password'=>'required',
        ]);
        if($Validator->fails()){
            return redirect()->route('tambah-admin')
                ->withErrors($Validator)
                ->withInput();
        }
        if($r->file('gambar')==Null){
            $update = Admin :: where('id_admin',$id)->update([
                'nama_admin'=>$r->nama_admin,
                'username'=>$r->username,
                'password' => Hash::make($r->password),
            ]);
        }
        else{
            $fotolama= DB::table('admins')->where('id_admin', $id)->first();
            //dd($fotolama);
            if ($fotolama->gambar != NULL) {
                unlink('gambar/'. $fotolama->gambar);
            }
            $file = $r->file('gambar');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file->move('gambar/',$fileName);

            $update = Admin::where('id_admin',$id)->update([
                'nama_admin'=>$r->nama_admin,
                'username'=>$r->username,
                'password' => Hash::make($r->password),
                'gambar'=> $fileName,
            ]);
        }
        if ($update == TRUE) {
            return redirect()->route('view-admin')->with('success','Data berhasil disimpan');
        }else{
            return redirect()->route('edit-admin')->with('error','Data gagal disimpan');
        }
    }

    public function hapusadmin($id){
        $hapus=DB::table('admins')->where('id_admin',$id)->delete();
        if ($hapus == TRUE) {
            return redirect()->route('view-admin')->with('success','Data berhasil dihapus');
        }else{
            return redirect()->route('view-admin')->with('error','Data gagal dihapus');
        }
    }

    public function profil(){
        $admin['admin'] = DB::table('admins')->where('id_admin',Session('id_admin'))->first();
        // dd($admin);
        return view('backend.admin.profil_admin',$admin);
    }

}
