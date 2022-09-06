<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\member;
use\App\Models\City;
use\App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Auth;

class AkunController extends Controller
{
    public function akun(){
        $id = Auth::user()->id;
        // dd($id);
        $data['jumlah']=DB::table('keranjangs')->where('id',session('id'))->count();
        $data['akun'] = DB::table('members')->where('id',$id)->first();
        $data['provinces'] = Province::pluck('name','province_id');
        // dd($data);
        return view ('frontend.akun.akun',$data);
    }

    public function getcities($id){
        $city = City::where('province_id',$id)->pluck('name','city_id');
        return response()->json($city);
    }

    public function editakun(Request $r,$id){
        $this->validate($r,[
            'nama_member' =>'required',
            'username_member' => 'required',
            'email_member' => 'required',
            'no_telepon' => 'required',
            'province_destination'=>'required',
            'city_destination'=>'required',
            'alamat_member' => 'required',
        ],[
            'province_destination.required'  => 'Provinsi tidak boleh kosong',
            'city_destination.required' => 'Provinsi dan Kota/Kabupeten tidak boleh kosong',
        ]);
        if($r->file('gambar')==''){
            member::where('id',$id)->update([
                'nama_member'=>$r->nama_member,
                'username_member'=>$r->username_member,
                'email_member'=>$r->email_member,
                'no_telepon'=>$r->no_telepon,
                'province_destination'=>$r->province_destination,
                'city_destination'=>$r->city_destination,
                'alamat_member'=>$r->alamat_member,
            ]);
        }
            else{
                $fotolama =DB::table('members')->where('id',$id)->first();
                if($fotolama->gambar != Null){
                    unlink('gambar/',$fileName);
                }
                $file = $request->file('gambar');
                $fileName = $file->getClientOriginalName();
                $file->move('gambar/',$fileName);

                member::where('id',$id)->update([
                    'nama_member'=>$r->nama_member,
                    'username_member'=>$r->username_member,
                    'email_member'=>$r->email_member,
                    'no_telepon'=>$r->np_telepon,
                    'province_destination'=>$r->province_destination,
                    'city_destination'=>$r->city_destination,
                    'alamat_member'=>$r->alamat_member,
                    'gambar'=>$fileName,
                ]);
            }
            return redirect()->route('view-akun');
    }
}
