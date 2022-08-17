<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminModel;
use Session;

class LoginAdminController extends Controller
{
    public function login(){
        return view ('backend.login');
    }

    public function aksilogintAdmin(Request $r){
       $id_admin = $r->id_admin;
       $username = $r->username;
       $password = $r->password;

       $data_admin = AdminModel::CheckLoginAdmin($username, $password);
        // dd($data_admin);
       if($data_admin == True){
           Session::put('id_admin',$data_admin->id_admin);
           Session::put('nama_admin', $data_admin->nama_admin);
           Session::put('username', $data_admin->username);
           Session::put('level_user', $data_admin->level_user);

           echo '<script>
                    alert("Login Sukses")
                    window.location = "dashboard"
                </script>';
       }
       else{
        echo '<script>
                alert("Username / Password Salah !")
                window.location = "/admin"
            </script>';
       }
    }

    public function logout(Request $r){
        Auth::guard('backend')->logout();
        $r->session()->regenerateToken();
        return redirect('/');
    }
}
