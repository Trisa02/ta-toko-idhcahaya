<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use\App\Models\City;
use\App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LoginController extends Controller
{
    public function loginmember(){
        return view('frontend.login');
    }

    public function aksi_login(Request $r)
    {
        $aksi = $r->validate([
            'username_member' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('member')->attempt($aksi)){
            $member = DB::table('members')->where('username_member',$r->username_member)->first();
            // dd($member);
            if(password_verify($r->password,$member->password))
            {
                $r->session()->regenerate();
                $r->session()->put('id',$member->id);
                return redirect('index-frontend');
            }
        }
        return back();
    }

    public function logout(Request $r){
        $r->session()->forget('id');
        Auth::guard('member')->logout();
        $r->session()->regenerateToken();
        return redirect('/');
    }

    public function register(){
        $provinces = Province::pluck('name','province_id');
        return view('frontend.register',compact('provinces'));
    }

    public function getcities($id){
        $city = City::where('province_id',$id)->pluck('name','city_id');
        return response()->json($city);
    }

    public function save_register(Request $request){
        $validator = Validator::make($request->all(),[
            'nama_member'=>'required',
            'username_member'=>'required',
            'password'=>'required',
            'email_member'=>'required',
            'province_destination'=>'required',
            'city_destination'=>'required',
            'no_telepon'=>'required',
            'alamat_member'=>'required',
            'gambar'=>'required',
        ]);

        if($validator->fails()){
            return redirect('register-member')
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('gambar');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file->move('gambar/',$fileName);

        $simpan = member::insert([
            'nama_member'=>$request->nama_member,
            'username_member'=>$request->username_member,
            'password'=>Hash::make($request->password),
            'email_member'=>$request->email_member,
            'no_telepon'=>$request->no_telepon,
            'province_destination'=>$request->province_destination,
            'city_destination'=>$request->city_destination,
            'alamat_member'=>$request->alamat_member,
            'gambar'=>$fileName,
        ]);
        // dd($simpan);
        if ($simpan == TRUE) {
            return redirect('index-frontend')->with('success','Data berhasil disimpan');
        }else{
            return redirect('register-member')->with('error','Data gagal disimpan');
        }
    }


}
